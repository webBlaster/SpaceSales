<?php
require('../classes/agents.php');
//variables
$username = '';
session_start();
$email = $_SESSION['email'];
$password = '';
$tablename = "spaces";
$authurl = '/SpaceSales/index.html';
$accesspage = '/SpaceSales/view/agents.html';
$Agents = new Agents($username,$email,$password,$tablename,$authurl,$accesspage);
$Agents->myspaces();
?>