<?o()?>
<?=$this->room?>
<br>
<div>Health: <?=$this->roomParams['health']?></div>
<div>Current Health: <?=$this->room->getHealth()?></div>

<a href="javascript:void(0)" class="spendHealth">Spend 10 health</a>
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
            <div class="panel panel-default" style="overflow-y: scroll">
                <div class="panel-body" style="height: 300px;">
                    <div style="text-align: right;" class="alert alert-success">test</div>
                    <div style="text-align: left;" class="alert alert-danger">test</div>
                    <div style="text-align: right;" class="alert alert-success">test</div>
                    <div style="text-align: left;" class="alert alert-danger">test</div>
                    <div style="text-align: right;" class="alert alert-success">test</div>
                    <div style="text-align: left;" class="alert alert-danger">test</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <input type="text" id="chat-input" class="form-control">
            <div>
        </div>
    </div>
    
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Health</th>
                        <th>Current health</th>
                        <th>Room</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?=$this->roomParams['health']?></td>
                        <td><?=$this->room->getHealth()?></td>
                        <td><?=$this->room?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
</div>
