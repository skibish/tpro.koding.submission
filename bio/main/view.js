var client = new Faye.Client('http://ulow.koding.io:8000/faye');
client.subscribe('/messages', function(message) {
    console.log('Got a message: ' + message.text);
    console.log(message);
});

$this.find('.spendHealth').click(function(){
    $this.remote('spendHealth', {health: -1000}, function(err, res){
        console.log(res);
        $this.refresh();
    });
    $this.find('#chat-output').append('Got a message: ' + message.text);
});


var map = AmCharts.makeChart("mapdiv", {
    type: "map",
    theme: "dark",
    titles: [
        {
            text: "Biosphere project",
            size: 16
            
        },
        {
            text: "Year 2014",
            size: 14
            
        }
    ],
    pathToImages: "/assets/map/images/",
    dataProvider: {
        map: "continentsLow",
        getAreasFromMap: true,
        areas: [
            {
                id: "LV",
                groupId: "eu"
                
            },
            {
                id: "LT",
                groupId: "eu"
                
            },
            {
                id: "RU",
                groupId: "ru"
                
            }
            ]
        
    },
    
    areasSettings: {
        autoZoom: true,
        selectedColor: "#CC0000"
        },
        smallMap: {}
});

map.addListener('clickMapObject', function(event) {
    console.log(event.mapObject.groupId);
    map.zoomToGroup(event.mapObject.groupId);
    
});

$this.find('#chat-input').on("keypress", function(event){
    if ( event.which == 13 ) {
        $this.remote(
            "submitChatText",
            {
                text: $(this).val()
            },
            function(err, res){
                if (res === true) {
                    alert('submitted!');
                }
            }
        );
    }
});

(function() {
    var app = angular.module('game', []);
    app.controller('WorldDataController', function($interval) {
        var self = this;
        self.json = '';
        
        $interval(function() {
            $this.remote("getWorldData", {}, function(err, res) {
                if (err) {
                    console.log('fail');    
                } else {
                    self.json = res;
                }
            });
        }, 1000);
    });

    app.controller('UsersDataController', function($interval) {
        var self = this;
        self.json = '';
        
        $interval(function() {
            $this.remote("getUsers", {}, function(err, res) {
                if (err) {
                    console.log('fail');
                } else {
                    console.log(res);
                    self.json = res;
                }
            });
        }, 1000);
    });
    
})();

$this.find('body > div > div > div.container.container-biosphere > div > div:nth-child(2) > ul > li:nth-child(2)').on("click", function(){
    $this.remote("getWorldData", {}, function(err, res) {
        if (err) {
            console.log('fail');
        } else {
            console.log(res);
        }
    });
});


