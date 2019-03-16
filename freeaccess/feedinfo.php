<?php
require('../classes/public.php');
$info = new Pbc();
$id = $_POST['id'];
$info->getfeed($id);
?>