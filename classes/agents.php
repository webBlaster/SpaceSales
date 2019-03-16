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

    public function uploadproductinfo($location,$price,$info,$tempname,$imagedir){
        require("../Inc/Database.php");
        //store product info in the database
        $sql = "INSERT INTO $this->tablename (agent,location,description,image,price) VALUES ('$this->email','$location','$info','$imagedir','$price')";
        if($conn->exec($sql)==1){
             //move image to image folder
            move_uploaded_file($tempname,$imagedir);
            $data = 1;
            echo json_encode($data);
        }else{
            $data = 0;
            echo json_encode($data);
        }
        
    }
    public function myspaces(){
        require('../Inc/Database.php');
        $sql = "SELECT * FROM $this->tablename WHERE agent ='$this->email'";
        $result = $conn->query($sql);
        if($result->rowcount()>0){
            $resultarray = array_reverse($result->fetchAll(PDO::FETCH_ASSOC));
            echo json_encode($resultarray);
        }
        else{
            $data = 0;
            echo json_encode($data);
        }
        
    }
    public function editproduct($id){
        echo "am working on".$id;
    }
}

?>