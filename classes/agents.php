<?php
require('users.php');
class Agents extends Users {

    function __construct($username,$email,$password,$tablename,$authurl,$accesspage){
        parent::__construct($email,$password,$tablename,$authurl,$accesspage);
        $this->username = $username;
    }

    public function registeragent(){
        $checksql = "SELECT * FROM $this->tablename WHERE email = '$this->email' OR username = '$this->username'";
        require("../Inc/Database.php");
        $checker = $conn->query($checksql);
        if($checker->rowcount()>0){
                $response = 0;
                echo json_encode($response);
        }else{
                $SQL = "INSERT INTO $this->tablename (username,email,password) VALUES ('$this->username','$this->email','$this->password')";
                $conn->exec($SQL);
                $response = 1;
                echo json_encode($response);
            }
    }
}

//$test = new Agents("adam merkem",'adammerkem@gmail.com','passowrd','agentdetails','','');
//$test->registeragent();
//$test->test();
?>