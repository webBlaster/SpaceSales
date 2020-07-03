<?php
require('../classes/users.php');
$authurl = '/index.html';
$accesspage = '/view/spacefeeds.html';
$user = new Users('','','',$authurl,$accesspage);
$auth = 'auth';
$user->Authstatus($auth);
?>