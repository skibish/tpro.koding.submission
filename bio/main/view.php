<?o()?>
<?=$this->room?>
<br>
<div>Health: <?=$this->roomParams['health']?></div>
<div>Current Health: <?=$this->room->getHealth()?></div>

<a href="javascript:void(0)" class="spendHealth">Spend 10 health</a>