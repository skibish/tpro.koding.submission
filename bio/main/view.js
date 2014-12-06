var client = new Faye.Client('http://dm1tpro1lv.koding.io:8000/faye');
client.subscribe('/messages', function(message) {
    console.log('Got a message: ' + message.text);
});