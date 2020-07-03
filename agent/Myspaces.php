<?php
require('../classes/agents.php');
//variables
$username = '';
$auth = "agentauth";
session_start();
$email = $_SESSION[$auth.'email'];
$password = '';
$tablename = "spaces";

$authurl = '/index.html';
$accesspage = '/view/agents.html';
$Agents = new Agents($username,$email,$password,$tablename,$authurl,$accesspage);
$Agents->myspaces();
?>