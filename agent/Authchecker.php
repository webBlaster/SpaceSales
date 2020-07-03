<?php
require('../classes/agents.php');
//set some variables
$auth = 'agentauth';
$tablename = "spaces";
$authurl = '/index.html';
$accesspage = '/view/agents.html';
$Agent = new Agents('','','',$tablename,$authurl,$accesspage);
$Agent->Authstatus($auth);