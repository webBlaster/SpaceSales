<?php
require('../classes/public.php');
$auth = "auth";
session_start();
$email = $_SESSION[$auth.'email'];
$Public = new Pbc();
$Public->getHistory($email);
