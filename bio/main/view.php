<? $users = array(); ?>
<? foreach($this->room->getUsers() as $user) { ?>
<? $users[] = array(
    'login' => $user->getUser()->getLogin(), 
    'hash' => $user->getUser()->getHash(), 
    'params' => json_decode($user['params'], true)
); ?>                                                                                    
<? } ?>
<?o('div', array('users' => $users, 'user'=>array('login'=>$this->user['login']), 'room_params'=>$this->roomParams, 'dt_created'=>$this->room['dt_created']))?>
<?/*<?=$this->room?>
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
*/?>

<div class="container container-biosphere ng" ng-modules="main">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default" style="margin: -1px -16px;">
                <div class="panel-body" style="padding: 0px; ">
                    <div id="mapdiv"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Actions</h3>
                </div>
                <div class="panel-body">
                    <div style="font-family: monospace">
                        <?foreach($this->localParams as $localParam => $properties){?>
                        <div class="btn-group" role="group" aria-label="<?=ucfirst($localParam)?>" style="margin-bottom: 4px;">
                            <a class="btn btn-sm btn-default" style="width: 320px;"><?=ucfirst($localParam)?></a>
                            <button type="button" class="btn btn-sm btn-success increase" data-param="<?=$localParam?>">+</button>
                            <button type="button" class="btn btn-sm btn-danger decrease" data-param="<?=$localParam?>">-</button>
                        </div>
                        <?}?>
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

<div class="row ng" ng-modules="main">
    <div class='col-md-12 info-bar' ng-controller='WorldDataController'>
        <div class='col-md-1'>
            <abbr title="Health">
                <span class="glyphicon glyphicon-heart" style="color: #e74c3c;" ng-click="spendHealth()"></span>
            </abbr>
            {{ worldParams['health'] | round }}
        </div>
        <div class='col-md-1'>
            <abbr title="Air">
                <span class="glyphicon glyphicon-cloud" style="color: #95a5a6;"></span>
            </abbr>
            {{ worldParams['pollution-air'] | round }}
        </div>
        <div class='col-md-1'>
            <abbr title="Water">
                <span class="glyphicon glyphicon-tint" style="color: #3498db;"></span>
            </abbr>
            {{ worldParams['pollution-water'] | round }}
        </div>
        <div class='col-md-1'>
            <abbr title="Earth">
                <span class="glyphicon glyphicon-globe" style="color: #16a085;"></span>
            </abbr>
            {{ worldParams['pollution-earth'] | round }}
        </div>
        <div class='col-md-1'>
            <abbr title="Oil">
                <span class="glyphicon glyphicon-tint" style="color: #34495e;"></span>
            </abbr>
            {{ worldParams['oil'] | round }}
        </div>
        <div class='col-md-1'>
            <abbr title="Coal">
                <span class="glyphicon glyphicon-fire" style="color: #e67e22;"></span>
            </abbr>
            {{ worldParams['coil'] | round }}
        </div>
        <div class='col-md-1'>
            <abbr title="Rain forests">
                <span class="glyphicon glyphicon-leaf" style="color: #2ecc71;"></span>
            </abbr>
            {{ worldParams['rain-forests'] | round }}
        </div>
    </div>
</div>
