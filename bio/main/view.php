<?o()?>
<?=$this->room?>
<br>
<div>Health: <?=$this->roomParams['health']?></div>
<div>Current Health: <?=$this->room->getHealth()?></div>
<div>My money: <?=$this->room->getUsers()->where(['user_id'=>$this->user['user_id']])->first()->getMoney()?></div>
<?foreach($this->room->getUsers() as $user){?>
    <div>
    <?=$user->getUser()?>
    <pre>
        <?
            $params = json_decode($user['params'],true);
            print_r($params);
        ?>
    </pre>
    
    </div>
<?}?>
<hr>
   <div>
    World
    <pre>
        <?
            print_r($this->roomParams);
        ?>
    </pre>
    </div>
<a href="javascript:void(0)" class="spendHealth">Spend 10 health</a>

<div class="container container-biosphere">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="mapdiv"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4" ng-controller='UsersDataController as users'>
        <!--
            <div ng-repeat="user in users.json.users">
                <p>{{ user['money'] }}</p>
                <p>{{ user['industry'] }}</p>
                <p>{{ user['applied-science'] }}</p>
                <p>{{ user['eco-science'] }}</p>
                <p>{{ user['medicine'] }}</p>
                <p>{{ user['population'] }}</p>
                <p>{{ user['taxes'] }}</p>
                <p>{{ user['happiness'] }}</p>
                <p>{{ user['work-places'] }}</p>
            </div> -->
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
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class='col-md-12 info-bar' ng-controller='WorldDataController as worldData'>
        <div class='col-md-1'>Health: {{ worldData.json['health'] }}</div>
        <div class='col-md-1'>Air: {{ worldData.json['pollution-air'] }}</div>
        <div class='col-md-1'>Water: {{ worldData.json['pollution-water'] }}</div>
        <div class='col-md-1'>Earth: {{ worldData.json['pollution-earth'] }}</div>
        <div class='col-md-1'>Oil: {{ worldData.json['oil'] }}</div>
        <div class='col-md-1'>Coil: {{ worldData.json['coil'] }}</div>
        <div class='col-md-1'>Forests: {{ worldData.json['rain-forests'] }}</div>
    </div>
</div>