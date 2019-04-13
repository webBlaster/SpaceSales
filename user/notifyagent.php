<?php
require("../classes/public.php");
$name = $_POST['name'];
$productid = $_POST['id'];
$number = $_POST['number'];
$auth = 'auth';
session_start();
$user = $_SESSION[$auth.'email'];
$public = new Pbc();
$public->notifyagent($productid,$name,$number,$user);
