<?php
require('../classes/public.php');

$productid = $_POST['id'];
$public = new Pbc();

$public->updateProductStatus($productid);