$this.find('.spendHealth').click(function(){
    $this.remote('spendHealth', {health: -1000}, function(err, res){
        console.log(res);
        $this.refresh();
    });
});

var map = AmCharts.makeChart("mapdiv", {
    type: "map",
    theme: "dark",
    preventDragOut: true,
    dragMap: false,
    titles: [
        {
            text: "Biosphere project",
            size: 16
            
        }
    ],
    pathToImages: "/assets/map/images/",
    dataProvider: {
        map: "continentsLow",
        getAreasFromMap: true,
        areas: [
            {
                id: "europe",
                title: "Europe"
            },
            {
                id: "north_america",
                title: "North America"
            },
            {
                id: "africa",
                title: "Africa"
            },
            {
                id: "asia",
                title: "Asia"
            }
        ],
    },
    
    areasSettings: {
        autoZoom: true,
        selectedColor: "#8e44ad",
    }
});

window.userMap = {};
window.customFunc = {
    getMapObject: function(login){
        return map.dataProvider.areas[userMap[login]];
    },
    updateUserData: function(users) {
        for(var key in users) {
            var mapObjects = map.dataProvider.areas;
            var user = users[key];
            
            for(var k in mapObjects) {
                var mapObject = mapObjects[k];
                if (mapObject.id === user['params']['country']) {
                    mapObject.params = user['params'];
                    mapObject.login = user['login'];
                    mapObject.color = '#'+user['hash'].substr(-6);
                    var getLighten = function(color, lum){
                        return Math.max(16, Math.min(255, Math.round(parseInt(color, 16) + lum))).toString(16);
                    };
                    var r = getLighten(mapObject.color.substr(1,2), 100),
                        g = getLighten(mapObject.color.substr(3,2), 100),
                        b = getLighten(mapObject.color.substr(5,2), 100);
                    var hoverColor = '#' + r + g + b;

                    mapObject.rollOverColor = hoverColor;
                    mapObject.selectedColor = mapObject.rollOverColor;
                    userMap[user['login']] = k;
                }
            }
        }
    },

    getRandomColor: function(userData) {
        /*var letters = '0123456789ABCDEF'.split('');
        var color = '#';
        for (var i = 0; i < 6; i++ ) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;*/
    }
}

var users = $this.data('users');
customFunc.updateUserData(users);

$this.find('#chat-input').on("keypress", function(event){
    if ( event.which == 13 ) {
        var $input = $(this);
        $input.css({'opacity':0.1}).attr('disabled', true);
        $this.remote(
            "submitChatText",
            {
                text: $input.val()
            },
            function(err, res){
                if (res === true) {
                    $input.val('');
                }
                $input.css({'opacity':1}).attr('disabled', false);
                $input.focus();
            }
        );
    }
});

/**
 * Listen on map areas clicks
 */



/**
 * Angular settings and logic
 */
(function() {
    var app = angular.module('main', []);
    app.controller('WorldDataController', function($scope, $interval) {
        $scope.worldParams = {};
        $scope.worldTime = '';
        $scope.client = new Faye.Client('http://ulow.koding.io:8000/faye');
        
        $scope.initFaye = function(){
            $scope.client.subscribe('/messages', function(message) {
                console.log(message);
                if(message.text){
                    var user = $this.data('user');
                    var color = (user.login == message.author)?'success':'info';
                    $this.find('.messagesPane').prepend('<div class="alert alert-'+color+'"><div class="author">'+message.author+' <span style="float: right;">'+moment().format("hh:mm:ss")+'</span></div> '+ message.text+'</div>');
                }
            });
            $scope.client.subscribe('/world', function(message) {
                console.log(message);
                if(message.world){
                    for(var k in message.world){
                        $scope.worldParams[k] += message.world[k];
                    }
                }else if(message.param){
                    var mapObject = customFunc.getMapObject(message.author);
                    mapObject.params[message.param] += message.amount;
                }else if(message.action){
                    if(message.action == 'send_money'){
                        var mapObjectSender = customFunc.getMapObject(message.author);
                        var mapObjectReceiver = customFunc.getMapObject(message.receiver);
                        mapObjectSender.params['money'] = parseInt(mapObjectSender.params['money']) - parseInt(message.amount);
                        mapObjectReceiver.params['money'] = parseInt(mapObjectReceiver.params['money']) + parseInt(message.amount);
                        mapObjectReceiver.updateTemplate();
                    }
                }
                $scope.$apply();
            });
        }();
        
        $scope.loadWorldData = function(){
            $this.remote("getWorldData", {}, function(err, res) {
                if (err) {
                    console.log('fail');    
                } else {
                    $scope.worldParams = world_params = res;
                    $scope.$apply();
                }
            });
        }();

        $scope.spendHealth = function(){
            $this.remote("spendHealth", {'health':-100}, function(err, res) {
                if (err) {
                    console.log('fail');    
                } else {
                }
            });
        };
        
        $scope.timeUpdate = function(){
            var timeDiff = moment().unix() - $this.data('dt_created');
            $scope.worldTime = moment(new Date((moment().unix() + (timeDiff * 60*60*24*30)) * 1000)).format("YYYY MMMM");
            //map.validateData();
        }

        $interval(function() {
            $scope.timeUpdate();

            if(!isNaN($scope.worldParams['pollution-air'])){
                for(var k in map.dataProvider.areas){
                    var userParams = map.dataProvider.areas[k].params;
                    var population = parseInt(userParams.population);

                    //ecology
                    var ecology = 0;
                    if(userParams['eco-science'] < 1000) {
                        ecology = 3;
                    }else if(userParams['eco-science'] < 5000){
                        ecology = 2.1;
                    }else{
                        ecology = 0.5;
                    }

                    //number of factories
                    var numOfFactories = (100*userParams.industry);
                    userParams['work-places'] = numOfFactories * 50;

                    //happiness
                    var sumPollution = (
                        $scope.worldParams['pollution-air'] + 
                        $scope.worldParams['pollution-water'] +
                        $scope.worldParams['pollution-earth']
                    );
                    var happiness = 0;
                    if (sumPollution > 1000){
                        happiness = -(sumPollution / 1000);
                    }else{
                        happiness = 1;
                    }

                    userParams.happiness = Math.min(
                        Math.max(
                            0, 
                            userParams.happiness + ((moment().unix() - $this.data('dt_created')) * happiness)
                        ), 100
                    );

                    //death number
                    var deathNumber = (((userParams['money']/userParams['work-places'] < userParams['population'])?100:0) + (
                        (population*0.1) + 
                        (1-parseInt(userParams.medicine)*0.5) +
                        (
                            (
                                (parseInt($scope.worldParams['pollution-air'])) +
                                (parseInt($scope.worldParams['pollution-water'])) +
                                (parseInt($scope.worldParams['pollution-water']))
                            ) / 300
                        ) + 
                        (
                            (100 - parseInt(userParams.happiness)) * 100
                        )
                    ) / 12) * 0.7;

                    //birth number
                    var birthNumber = 100 + (userParams.happiness * (userParams.medicine/100));
                    userParams.population = (population <= 0) ? 0 : Math.max(
                        0, 
                        userParams.population + ((moment().unix() - $this.data('dt_created')) * (birthNumber-deathNumber))
                    );

                    //earnings
                    var earnings = (numOfFactories * 
                        (1 + userParams['applied-science']/100) + 
                        Math.min(userParams['work-places'], userParams['population']) * 0.0001 * userParams['taxes']) -
                        userParams['work-places']/userParams['population'];
                    userParams.money = Math.max(0, userParams.money + ((moment().unix() - $this.data('dt_created')) * earnings));

                    /**********/
                    /* GLOBAL */
                    /**********/

                    //trees
                    var trees = 500 - 
                        (
                            $scope.worldParams['pollution-air'] + 
                            $scope.worldParams['pollution-water'] +
                            $scope.worldParams['pollution-earth']
                        ) / 1000;
                    $scope.worldParams['rain-forests'] = Math.max(
                        0, 
                        $scope.worldParams['rain-forests'] + ((moment().unix() - $this.data('dt_created')) * trees)
                    );

                    //pollution
                    var pollution       = userParams['industry'] * ecology;
                    var pollutionAir    = pollution - ((7 + $scope.worldParams['rain-forests']/1000) + (7 + userParams['eco-science']/1000));
                    var pollutionWater  = pollution - ((10 + userParams['eco-science'] / 1000));
                    var pollutionEarth  = pollution - ((5 + $scope.worldParams['rain-forests']/1000) + (5 + userParams['eco-science']/1000));

                    $scope.worldParams['pollution-air']   = Math.min(
                        Math.max(
                            0, 
                            $scope.worldParams['pollution-air'] + ((moment().unix() - $this.data('dt_created')) * pollutionAir)
                        ), 100
                    );
                    $scope.worldParams['pollution-water'] = Math.min(
                        Math.max(
                            0, 
                            $scope.worldParams['pollution-water'] + ((moment().unix() - $this.data('dt_created')) * pollutionWater)
                        ), 100
                    );
                    $scope.worldParams['pollution-earth'] = Math.min(
                        Math.max(
                            0, 
                            $scope.worldParams['pollution-earth'] + ((moment().unix() - $this.data('dt_created')) * pollutionEarth)
                        ), 100
                    );

                    //factory waste
                    var coalWaste = 0;
                    var forestWaste = 0;
                    var oilWaste = 0;
                    if(userParams['eco-science'] < 1000){
                        coalWaste   = userParams.industry * 1;
                        forestWaste = userParams.industry * 1;
                    }else if(userParams['eco-science'] < 5000){
                        coalWaste   = userParams.industry * 0.5;
                        forestWaste = userParams.industry * 0.1;
                    }else{
                        coalWaste   = userParams.industry * 0.1;
                        forestWaste = userParams.industry * 0;
                        oilWaste = userParams.industry * 0.4;
                    }

                    $scope.worldParams['coal'] = Math.max(
                        0, 
                        $scope.worldParams['coal'] - ((moment().unix() - $this.data('dt_created')) * coalWaste)
                    );

                    $scope.worldParams['rain-forests'] = Math.max(
                        0, 
                        $scope.worldParams['rain-forests'] - ((moment().unix() - $this.data('dt_created')) * forestWaste)
                    );

                    $scope.worldParams['oil'] = Math.max(
                        0, 
                        $scope.worldParams['oil'] - ((moment().unix() - $this.data('dt_created')) * oilWaste)
                    );

                    //customFunc.getMapObject($this.data('user').login).params = userParams;
                }
            }
        }, 1000); 
        
    });

    /**
     * Main purpose, generate User data preview
     */
    app.controller('UserController', function($scope) {
        $scope.usersData = {};
        map.addListener('clickMapObject', function(e) {
            $scope.usersData['login'] = e.mapObject.login;
            $scope.usersData['params'] = e.mapObject.params;
        });
    });

    app.filter('round', function(){
        return function(input){
            return Math.round(input, 0);
        }
    });
    
})();

angular.bootstrap($this.find('.ng'), ['main']);


/**
 * Oxygen logic
 */
$this.find('.increase').click(function(){
    $this.remote('increase', {
        param: $(this).data("param")
    }, function(err, res){
        if(err){
            console.log(err);
        }
    });
});

$this.find('.decrease').click(function(){
    $this.remote('decrease', {
        param: $(this).data("param")
    }, function(err, res){
        if(err){
            console.log(err);
        }
    });
});

$this.find('.sendMoney').click(function(){
    $this.remote('sendMoney', {
        receiver: $this.find('.receiver').val(),
        amount: $this.find('.amount').val()
    }, function(err, res){
        if(err){
            console.log(err);
        }
    });
});