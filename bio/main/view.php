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

<div class="container container-biosphere ng" ng-modules="main" ng-controller="UserController">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="mapdiv"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            
            <!-- Actions -->
            <div class="panel panel-default">
                <div class="panel-body">
                    <div role="tabpanel">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#actions" aria-controls="home" role="tab" data-toggle="tab">Actions</a></li>
                            <li role="presentation"><a href="#active-user" aria-controls="profile" role="tab" data-toggle="tab">{{ usersData.login }}</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="actions">
                                <div style="font-family: monospace">
                                    <?foreach($this->localParams as $localParam => $properties){?>
                                        <div class="btn-group" role="group" aria-label="<?=ucfirst($localParam)?>" style="margin-bottom: 4px;">
                                            <a class="btn btn-sm btn-default" style="width: 320px;"><?=ucfirst($localParam)?></a>
                                            <button type="button" class="btn btn-sm btn-success increase" data-param="<?=$localParam?>">+</button>
                                            <button type="button" class="btn btn-sm btn-danger decrease" data-param="<?=$localParam?>">-</button>
                                        </div>
                                    <?}?>
                                <div style="margin-bottom: 4px;">
                                    <input type="text" class="receiver" placeholder="Recever login" style="width: 180px">
                                    <input type="text" class="amount" placeholder="Amount" style="width: 80px">
                                    <button type="button" class="btn btn-sm btn-success sendMoney">Send</button>
                                </div>
                            </div>
                        </div>
                            <div role="tabpanel" class="tab-pane" id="active-user">
                                Applied science: {{ usersData.params['applied-science'] }}<br>
                                Eco science: {{ usersData.params['eco-science'] }}<br>
                                Industry: {{ usersData.params['industry'] }}<br>
                                Medicine: {{ usersData.params['medicine'] }}<br>
                                Money: {{ usersData.params['money'] }}<br>
                                Population: {{ usersData.params['population'] }}<br>
                                Population: {{ usersData.params['population'] }}<br>
                                Taxes: {{ usersData.params['taxes'] }}<br>
                                Work places: {{ usersData.params['work-places'] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Actions -->
            
            <!-- Chat box -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Chat</h3>
                </div>
                <div class="messagesPane panel-body" style="height: 240px; overflow-y: scroll">
                </div>
            </div>
            <!-- /Chat box -->
            
            <!-- Chat input -->
            <div class="form-group" ng-modules="main">
                <input type="text" id="chat-input" class="form-control" placeholder="<?= $this->user['login'] ?>, say hello to everyone!">
            </div>
            <!-- /Chat input -->
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
            {{ worldParams['coal'] | round }}
        </div>
        <div class='col-md-1'>
            <abbr title="Rain forests">
                <span class="glyphicon glyphicon-leaf" style="color: #2ecc71;"></span>
            </abbr>
            {{ worldParams['rain-forests'] | round }}
        </div>
        <div class='col-md-3'>
            <strong> Current time: {{ worldTime }}<strong>
        </div>
    </div>
</div>