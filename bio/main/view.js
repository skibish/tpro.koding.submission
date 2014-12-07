var client = new Faye.Client('http://ulow.koding.io:8000/faye');
client.subscribe('/messages', function(message) {
    console.log(message);
    if(message.text){
        var user = $this.data('user');
        var color = (user.login == message.author)?'success':'info';
        $this.find('.messagesPane').prepend('<div class="alert alert-'+color+'"><div class="author">'+message.author+' <span style="float: right;">'+moment().format("hh:mm:ss")+'</span></div> '+ message.text+'</div>');
    }
});

$this.find('.spendHealth').click(function(){
    $this.remote('spendHealth', {health: -1000}, function(err, res){
        console.log(res);
        $this.refresh();
    });
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
                id: "europe",
                title: "<h1>Holy</h1>"
            },
            {
                id: "afrika",
                title: "<h1>Holy</h1>",
            }
        ],
    },
    
    areasSettings: {
        autoZoom: true,
        selectedColor: "#CC0000"
        },
        smallMap: {}
});

var users = [{country: "europe"},{country: "afrika"}];


console.log(map.dataProvider.areas[1].title)

map.addListener('rollOverMapObject', function(event) {
    console.log(event.mapObject.chart.customData);
    map.zoomToGroup(event.mapObject.groupId);
});

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
    var app = angular.module('game', []);
    app.controller('WorldDataController', function($interval) {
        var self = this;
        self.json = '';
        
            $this.remote("getWorldData", {}, function(err, res) {
                if (err) {
                    console.log('fail');    
                } else {
                    self.json = res;
                }
            });
    });

    app.controller('UsersDataController', function($interval) {
        var self = this;
        self.json = '';
        
            $this.remote("getUsers", {}, function(err, res) {
                if (err) {
                    console.log('fail');
                } else {
                    self.json = res;
                }
            });
    });
    
})();
