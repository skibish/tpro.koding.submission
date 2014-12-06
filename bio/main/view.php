<?o()?>
<div class="container container-biosphere">
    <div class="row">
        <div class="col-md-8">
            <div id="mapdiv"></div>
        </div>
        <div class="col-md-4">
            <ul class="nav nav-pills nav-stacked">
                <li role="presentation" class="active"><a href="#">Home</a></li>
                <li role="presentation"><a href="#">Profile</a></li>
                <li role="presentation"><a href="#">Messages</a></li>
            </ul>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <textarea class="form-control" id="chat-output" rows="5" disabled></textarea>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <input type="text" id="chat-input" class="form-control">
            <div>
        </div>
    </div>
    <div class="row well">
        <div class="col-md-3">
            Health: <?=$this->roomParams['health']?>
        </div>
        <div class="col-md-3">
            Current Health: <?=$this->room->getHealth()?>
        </div>
        <div class="col-md-3">
            <?=$this->room?>
        </div>
        <div class="col-md-3">
            Param Y
        </div>
    </div>
</div>
