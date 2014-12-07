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
        images: [{
            zoomLevel: 5,
            scale: 0.5,
            title: "Brussels",
            latitude: 50.8371,
            longitude: 4.3676
        }]
        
    },
    customData: {test:3},
    
    areasSettings: {
        autoZoom: true,
        selectedColor: "#CC0000"
        },
        smallMap: {}
});

map.addListener('clickMapObject', function(event) {
    console.log(event.mapObject);
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



function updateCustomMarkers () {
    // get map object
    
    console.log(map);
    return;
    var map = event.chart;
    
    // go through all of the images
    for( var x in map.dataProvider.images) {
        // get MapImage object
        var image = map.dataProvider.images[x];
        
        // check if it has corresponding HTML element
        if ('undefined' == typeof image.externalElement)
            image.externalElement = createCustomMarker(image);

        // reposition the element accoridng to coordinates
        image.externalElement.style.top = map.latitudeToY(image.latitude) + 'px';
        image.externalElement.style.left = map.longitudeToX(image.longitude) + 'px';
    }
}


// this function creates and returns a new marker element
function createCustomMarker(image) {
    // create holder
    var holder = document.createElement('div');
    holder.className = 'map-marker';
    holder.title = image.title;
    holder.style.position = 'absolute';
    
    // maybe add a link to it?
    if (undefined != image.url) {
        holder.onclick = function() {
            window.location.href = image.url;
        };
        holder.className += ' map-clickable';
    }
    
    // create dot
    var dot = document.createElement('div');
    dot.className = 'dot';
    holder.appendChild(dot);
    
    // create pulse
    var pulse = document.createElement('div');
    pulse.className = 'pulse';
    holder.appendChild(pulse);
    
    // append the marker to the map container
    image.chart.chartDiv.appendChild(holder);
    
    image.externalElement.style.top = map.latitudeToY(image.latitude) + 'px';
    image.externalElement.style.left = map.longitudeToX(image.longitude) + 'px';
}

console.log(map.dataProvider.images)

