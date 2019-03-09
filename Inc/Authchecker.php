<?php
require('../classes/users.php');
$authurl = '/SpaceSales/index.html';
$accesspage = '/SpaceSales/view/spacefeeds.html';
$user = new Users('','','',$authurl,$accesspage);
$user->Authstatus();
?>