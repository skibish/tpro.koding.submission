var $search = $this.find('.search');
var $items = $this.find('.items');

//console.log($items);

var tmpSearch = $search.val();
$search.keydown(_.debounce(function(){
	//$result.text($search.val());
	if(tmpSearch!=$search.val() && $search.val().length>0){
		$items.html('<loader>');
		$items.removeClass('collapsed').addClass('expanded');		
		$this.remoteSafe(
			'getItems', {
				criteria: $search.val(),
				nodeTemplate: 'node'
			}, function(res){
			if($items.html()==res.body){
				return false;
			}
			if(res.body != ''){
				$items.embed(res, true); 
				//console.log(res);
			}else{
				$items.html('<span class="disabled">empty result</span>');
			}
		});
	}
	tmpSearch = $search.val();
}, ($search.val().length>3)?50:800));

$search.focusout(function(){
	if(tmpSearch!=$search.val() && $search.val().length>3){
		$items.html('<loader>');
		$items.removeClass('collapsed').addClass('expanded');		
		$this.remoteSafe(
			'getItems', {
				criteria: $search.val(),
				nodeTemplate: 'node'
			}, function(res){
			if($items.html()==res.body){
				return false;
			}
			if(res.body != ''){
				$items.embed(res, true); 
				//console.log(res);
			}else{
				$items.html('<span class="disabled">empty result</span>');
			}
		});
		tmpSearch = $search.val();
	}
});