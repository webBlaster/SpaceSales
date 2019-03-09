<?php
include('Config.php');
    $servername = DB_HOST;
    $user_name = DB_USER;
    $pass_word = DB_PASS;
    $dbname = DB_NAME;
    try{
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user_name, $pass_word);
    }
    catch(PDOException $e){
        echo "Connection Failed:" . $e->getMessage();
    }
    ?>