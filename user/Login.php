<?php
require('../classes/users.php');

//sanitize data first
$email = htmlentities($_POST['si-email']);
$password = MD5(htmlentities($_POST['si-password']));
$tablename = 'userdetails';
$authurl = '/SpaceSales/index.html';
$accesspage = '/SpaceSales/view/spacefeeds.html';

//instantiate the user class ,set the arguments and call 
//some of its methods
$User = new Users($email,$password,$tablename,$authurl,$accesspage);
$User->Login();
?>