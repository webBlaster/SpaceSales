<?php
require('../classes/users.php');
$authurl = '/SpaceSales/index.html';
$accesspage = '/SpaceSales/view/spacefeeds.html';
$auth = 'auth';
$user = new Users('','','',$authurl,$accesspage);
$user->Logout($auth);
?>