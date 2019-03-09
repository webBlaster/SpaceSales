<?php
require('../classes/agents.php');
$authurl = '/SpaceSales/index.html';
$accesspage = '';
$user = new Agents('','','','',$authurl,$accesspage);
$user->Logout();
?>