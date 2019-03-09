<?php
require('../classes/agents.php');
//sanitize data from client side
$username = htmlentities($_POST['agentsu-name']);
$email = htmlentities($_POST['agentsu-email']);
$password = MD5(htmlentities($_POST['agentsu-password']));

$tablename = "agentdetails";
$authurl = '';
$accesspage = '';

$Agent = new Agents($username,$email,$password,$tablename,$authurl,$accesspage);
$Agent->registeragent();
?>