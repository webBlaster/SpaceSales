<?php
require('../classes/users.php');
$authurl = '/index.html';
$accesspage = '/view/spacefeeds.html';
$auth = 'auth';
$user = new Users('','','',$authurl,$accesspage);
$user->Logout($auth);
?>