<?php
//requires the user class
require_once("../classes/users.php");

//form input from the client side
$email=htmlentities($_POST['su-email']);
$password = MD5(htmlentities($_POST['su-password']));
$tablename = 'userdetails';
$authurl = '/SpaceSales/index.html';
$accesspage = '/SpaceSales/view/spacefeeds.html';

//initializing a new user class and calling some of its methods
$User = new Users($email,$password,$tablename,$authurl,$accesspage);
$User->register();