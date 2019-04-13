<?php
require('../classes/agents.php');
$title = $_POST['title'];
$location = $_POST['location'];
$price = $_POST['price'];
$info = $_POST['info'];
//image directory to be sent to db
define("directory","../Spaceimage/");
$tempname = $_FILES['file']['tmp_name'];
$FileExt = explode('.' , $_FILES['file']['name']);
$Ext = strtolower(end($FileExt));
$name = rand(100,999).'.'.$Ext;
$imagedir = directory.$name;
$password = '';
$tablename = "spaces";
$auth = "agentauth";
$authurl = '/SpaceSales/index.html';
$accesspage = '/SpaceSales/view/agents.html';
session_start();
$email = $_SESSION[$auth.'email'];


$Agents = new Agents('',$email,$password,$tablename,$authurl,$accesspage);
$Agents->uploadproductinfo($title,$location,$price,$info,$tempname,$imagedir);
?>