<?php
require('../classes/agents.php');
$authurl = '/SpaceSales/index.html';
$accesspage = '';
$auth = "agentauth";
$user = new Agents('','','','',$authurl,$accesspage);
$user->Logout($auth);
?>