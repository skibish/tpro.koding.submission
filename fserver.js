var http = require('http'),
    faye = require('faye');

var bayeux = new faye.NodeAdapter({mount: '/faye', timeout: 45});

// Handle non-Bayeux requests
var server = http.createServer(function(request, response) {
  response.writeHead(200, {'Content-Type': 'text/plain'});
  response.end('Hello, non-Bayeux request');
});

var fs = require('fs');

var authToken = 'h8yg7tf6r45ed5rf6gt7y8';

var serverAuth = {
  incoming: function(message, callback) {
    if(['/messages','/world','/system'].indexOf(message.channel)>=0){
        
        console.log(message);
        if(!message.data.authToken || message.data.authToken != authToken){
            message = {};
            //console.log('No auth token');
        }else{
            message.data.authToken = null;
        }
    }
    // Call the server back now we're done
    callback(message);
  }
};

bayeux.addExtension(serverAuth);

bayeux.attach(server);
server.listen(8000);