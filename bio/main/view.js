var client = new Faye.Client('http://dm1tpro1lv.koding.io:8000/faye');
client.subscribe('/messages', function(message) {
    console.log('Got a message: ' + message.text);
    console.log(message);
});

$this.find('.spendHealth').click(function(){
    $this.remote('spendHealth', {health: -1000}, function(err, res){
        console.log(res);
        $this.refresh();
    });
});