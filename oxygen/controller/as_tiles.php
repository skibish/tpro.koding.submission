<?if($this->child){?>
    <?$this->child->put()?>
<?}else{?>
    <?foreach($this as $child){?>
        <?if(!$child->isHidden()){?>
            <?$child->put_as_tile()?>
        <?}?>
    <?}?>
<?}?>