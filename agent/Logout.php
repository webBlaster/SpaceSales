<?php
require('../classes/agents.php');
$authurl = '/index.html';
$accesspage = '';
$auth = "agentauth";
$user = new Agents('','','','',$authurl,$accesspage);
$user->Logout($auth);
?>