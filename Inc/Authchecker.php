<?php
require('../classes/users.php');
$authurl = '/SpaceSales/index.html';
$accesspage = '/view/spacefeeds.html';
$user = new Users('','','',$authurl,$accesspage);
$auth = 'auth';
$user->Authstatus($auth);
?>