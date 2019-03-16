<?php
require('../classes/agents.php');
$location = $_POST['location'];
$price = $_POST['price'];
$info = $_POST['info'];
$id = $_POST['id'];
//image directory to be sent to db
define("directory","../Spaceimage/");
$tempname = $_FILES['file']['tmp_name'];
$FileExt = explode('.' , $_FILES['file']['name']);
$Ext = strtolower(end($FileExt));
$name = rand(100,999).'.'.$Ext;
$imagedir = directory.$name;
$password = '';
$tablename = "spaces";
$authurl = '/SpaceSales/index.html';
$accesspage = '/SpaceSales/view/agents.html';

$Agents = new Agents('','',$password,$tablename,$authurl,$accesspage);
$Agents->editproduct($id);
?>