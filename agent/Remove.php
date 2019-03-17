<?php 
require('../classes/agents.php');
$password = '';
$tablename = "spaces";
$authurl = '/SpaceSales/index.html';
$accesspage = '/SpaceSales/view/agents.html';
$id = $_POST['id'];
$Agents = new Agents('','',$password,$tablename,$authurl,$accesspage);
$Agents->removeproduct($id);