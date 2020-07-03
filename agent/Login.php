<?php
require('../classes/agents.php');
//sanitize data from client side
$email = htmlentities($_POST['agentsi-email']);
$password = MD5(htmlentities($_POST['agentsi-password']));
$auth = "agentauth";
$tablename = "agentdetails";
$authurl = '/index.html';
$accesspage = '/view/agents.html';

$Agent = new Agents('',$email,$password,$tablename,$authurl,$accesspage);
$Agent->Login($auth);
?>