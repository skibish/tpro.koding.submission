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
                title: "<h1>Holy</h1>"
            },
            {
                id: "north_america",
                title: "<h1>Holy</h1>"
            },
            {
                id: "africa",
                title: "<h1>Holy</h1>"
            },
            {
                id: "asia",
                title: "<h1>Holy</h1>"
            }
        ],
    },
    
    areasSettings: {
        autoZoom: true,
        selectedColor: "#8e44ad",
    },
    smallMap: {}
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
                    mapObject.template = function() {
                        var html = "<div> Login: "+ this.login +"</div>";
                        html += "<div> Country: "+ this.params.country +"</div>";
                        html += "<div>Applied science: "+ this.params['applied-science'] +"</div>";
                        html += "<div>Eco science: "+ this.params['eco-science'] +"</div>";
                        html += "<div> industry: "+ this.params['industry'] +"</div>";
                        html += "<div> Medicine: "+ this.params['medicine'] +"</div>";
                        html += "<div> Money: "+ this.params['money'] +"</div>";
                        html += "<div> Population: "+ this.params['population'] +"</div>";
                        html += "<div> Taxes: "+ this.params['taxes'] +"</div>";
                        html += "<div>Work places: "+ this.params['work-places'] +"</div>";
                        return html;
                    };
                    mapObject.updateTemplate = function() {
                        this.title = this.template();
                    };

                    mapObject.updateTemplate();

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
                    mapObject.updateTemplate();
                    map.validateData();
                }else if(message.action){
                    if(message.action == 'send_money'){
                        var mapObjectSender = customFunc.getMapObject(message.author);
                        var mapObjectReceiver = customFunc.getMapObject(message.receiver);
                        mapObjectSender.params['money'] = parseInt(mapObjectSender.params['money']) - parseInt(message.amount);
                        mapObjectSender.updateTemplate();
                        mapObjectReceiver.params['money'] = parseInt(mapObjectReceiver.params['money']) + parseInt(message.amount);
                        mapObjectReceiver.updateTemplate();
                        map.validateData();
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
            $scope.worldTime = moment(new Date((moment().unix() + (timeDiff * 60*60*24*30)) * 1000)).format("MMMM YYYY");
            //map.validateData();
        }

        $interval(function() {
            $scope.worldParams['oil'] = Math.min(Math.max(0, $this.data('room_params').oil - (moment().unix() - $this.data('dt_created')) * (0.05 * 1000)));
            $scope.timeUpdate();
        }, 50); 
        
    });

    app.filter('round', function(){
        return function(input){
            return Math.round(input, 0);
        }
    });
    
})();

angular.bootstrap($this.find('.ng'), ['main']);


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