<?php
require('../classes/agents.php');
session_start();
$auth = "agentauth";
$email = $_SESSION[$auth.'email'] ;
$tablename = 'agentdetails';

$Agent = new Agents('',$email,'',$tablename,'','');
$Agent->notification($email);