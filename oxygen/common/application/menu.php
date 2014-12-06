<?o('td')?>
<ul class="first-level">
	<?foreach($this as $child):?>
	<?if(!$child->isHidden()){?>
		<?if($child->isActive):?>
			<li class="expanded">
				<a class="title" href="<?=$child->go(false)?>"><?$child->put_icon()?><?=$child?></a>
				<?if(count($child)>0 && $child->showInMenu && get_class($child)!='Oxygen_Entity_Collection'):?>
				<ul class="second-level">
					<?foreach($child as $subchild):?>
					<?if($subchild->isActive):?>
						<li class="expanded">
							<a class="title" href="<?=$subchild->go(false)?>"><?$subchild->put_icon()?><?=$subchild?></a>
						</li>
					<?else:?>
						<li class="collapsed">
							<a class="title" href="<?=$subchild->go(false)?>"><?$subchild->put_icon()?><?=$subchild?></a>
						</li>
					<?endif?>
					<?endforeach?>
				</ul>
				<?endif?>
			</li>
		<?else:?>
			<li class="collapsed">
				<a class="title" href="<?=$child->go(false)?>"><?$child->put_icon()?><?=$child?></a>
			</li>
		<?endif?>
	<?}?>
	<?endforeach?>
	<?//$this->put_clear_cache()?>
	<?//$this->put_reflect_database()?>
</ul>
