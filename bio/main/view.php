<? $users = array(); ?>
<? foreach($this->room->getUsers() as $user) { ?>
<? $users[] = array(
    'login' => $user->getUser()->getLogin(), 
    'hash' => $user->getUser()->getHash(), 
    'params' => json_decode($user['params'], true)
); ?>                                                                                    
<? } ?>
<?o('div', array('users' => $users, 'user'=>array('login'=>$this->user['login']), 'room_params'=>$this->roomParams, 'dt_created'=>$this->room['dt_created']))?>
<?/*<?=$this->room?>320px
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
                            <li role="presentation"><a href="#active-user" aria-controls="profile" role="tab" data-toggle="tab">{{ usersData.login | uppercase }}</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="actions">
                                <div class='row'>
                                    <?foreach($this->localParams as $localParam => $properties){?>
                                        <div class="btn-group col-md-12" role="group" aria-label="<?=ucfirst($localParam)?>" style="margin-bottom: 4px;">
                                            <div style='width:100%'>
                                                <a class="col-md-10 btn btn-sm btn-default"><?=ucfirst($localParam)?></a>
                                                <button type="button" class="col-md-1 btn btn-sm btn-success increase" data-param="<?=$localParam?>">+</button>
                                                <button type="button" class="col-md-1 btn btn-sm btn-danger decrease" data-param="<?=$localParam?>">-</button>
                                            </div>
                                        </div>
                                    <?}?>
                      
                                <div class='row'>
                                    <div class='col-md-12'>
                                        <div class='col-md-4'>
                                            <input type='text' placeholder='Reciever' class='form-control receiver'>
                                        </div>
                                        <div class='col-md-4'>
                                            <input type='text' placeholder='Amount' class='form-control amount'>
                                        </div>
                                          <div class='col-md-4'>
                                            <input type='button' value='Send' class='btn-success form-control sendMoney'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div role="tabpanel" class="tab-pane" id="active-user">
                                <table class="table well" style="margin-top: 20px;">
                                    <tr>
                                        <th>Applied science</th>
                                        <td>{{ usersData.params['applied-science'] }}</td>
                                    </tr>
                                    
                                    <tr>
                                       <th>Eco science</th>
                                       <td>{{ usersData.params['eco-science'] }}</td>
                                    </tr>
                                    
                                    <tr>
                                         <th>Industry</th>
                                         <td>{{ usersData.params['industry'] }}</td>
                                         
                                    </tr>
                                    
                                    <tr>
                                       <th>Medicine</th>
                                       <td>{{ usersData.params['medicine'] }}</td>
                                    </tr>
                                     
                                    <tr>
                                        <th>Money</th>
                                        <td>{{ usersData.params['money'] | currency }}</td>
                                    </tr>
                                    <tr>
                                        <th>Population</th>
                                        <td>{{usersData.params['population'] | number:0 }}</td>
                                    </tr>
                                       
                                    <tr>
                                        <th>Taxes</th>
                                        <td>{{ usersData.params['taxes'] }}</td>
                                    </tr>
                                       
                                    <tr>
                                        <th>Work places</th>
                                        <td>{{ usersData.params['work-places'] }}</td>
                                    </tr>
                                </table>
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
                <div class="messagesPane panel-body" style="height: 200px; overflow-y: scroll">
                </div>
                <div class="panel-footer">
                    <!-- Chat box -->
                    <div class="form-group" ng-modules="main">
                        <input type="text" id="chat-input" class="form-control" placeholder="<?= $this->user['login'] ?>, say hello to everyone!">
                    </div>
                    <!-- /Chat input -->
                </div>
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