<?php 
require('../classes/agents.php');
$password = '';
$tablename = "spaces";
$authurl = '/index.html';
$accesspage = '/view/agents.html';
$id = $_POST['id'];
$Agents = new Agents('','',$password,$tablename,$authurl,$accesspage);
$Agents->removeproduct($id);