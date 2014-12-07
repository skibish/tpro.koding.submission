<?o('div', array('user'=>array('login'=>$this->user['login'])))?>
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
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Actions</h3>
                </div>
                <div class="panel-body">
                    <div class="btn-group" role="group" aria-label="...">
                        <button type="button" class="btn btn-default">Left</button>
                        <button type="button" class="btn btn-default">Middle</button>
                        <button type="button" class="btn btn-default">Right</button>
                    </div>
                    <div class="btn-group" role="group" aria-label="...">
                        <button type="button" class="btn btn-default">Left</button>
                        <button type="button" class="btn btn-default">Middle</button>
                        <button type="button" class="btn btn-default">Right</button>
                    </div>
                    <div class="btn-group" role="group" aria-label="...">
                        <button type="button" class="btn btn-default">Left</button>
                        <button type="button" class="btn btn-default">Middle</button>
                        <button type="button" class="btn btn-default">Right</button>
                    </div>
                </div>
            </div>
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
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Chat</h3>
                </div>
                <div class="messagesPane panel-body" style="height: 300px; overflow-y: scroll">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <input type="text" id="chat-input" class="form-control" placeholder="Say hello to everyone">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class='col-md-12 info-bar' ng-controller='WorldDataController as worldData'>
        <div class='col-md-1'>
            <abbr title="Health">
                <span class="glyphicon glyphicon-heart" style="color: #e74c3c;"></span>
            </abbr>
            {{ worldData.json['health'] }}
        </div>
        <div class='col-md-1'>
            <abbr title="Air">
                <span class="glyphicon glyphicon-cloud" style="color: #95a5a6;"></span>
            </abbr>
            {{ worldData.json['pollution-air'] }}
        </div>
        <div class='col-md-1'>
            <abbr title="Water">
                <span class="glyphicon glyphicon-tint" style="color: #3498db;"></span>
            </abbr>
            {{ worldData.json['pollution-water'] }}</div>
        <div class='col-md-1'>
            <abbr title="Earth">
                <span class="glyphicon glyphicon-globe" style="color: #16a085;"></span>
            </abbr>
            {{ worldData.json['pollution-earth'] }}
        </div>
        <div class='col-md-1'>
            <abbr title="Oil">
                <span class="glyphicon glyphicon-tint" style="color: #34495e;"></span>
            </abbr>
            {{ worldData.json['oil'] }}
        </div>
        <div class='col-md-1'>
            <abbr title="Coal">
                <span class="glyphicon glyphicon-fire" style="color: #e67e22;"></span>
            </abbr>
            {{ worldData.json['coil'] }}
        </div>
        <div class='col-md-1'>
            <abbr title="Rain forests">
                <span class="glyphicon glyphicon-tree-deciduous" style="color: #2ecc71;"></span>
            </abbr>
            {{ worldData.json['rain-forests'] }}
        </div>
    </div>
</div>
