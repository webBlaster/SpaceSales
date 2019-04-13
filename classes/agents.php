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
                $SQL = "INSERT INTO $this->tablename (username,email,password,notification) VALUES ('$this->username','$this->email','$this->password',0)";
                $conn->exec($SQL);
                $response = 1;
                echo json_encode($response);
            }
    }

    public function uploadproductinfo($title,$location,$price,$info,$tempname,$imagedir){
        require("../Inc/Database.php");
        //store product info in the database
        $sql = "INSERT INTO $this->tablename (agent,title,location,description,image,price,status) VALUES ('$this->email','$title','$location','$info','$imagedir','$price','available')";
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
    public function editproduct($title,$location,$price,$info,$tempname,$id,$imagedir){
        
        require("../Inc/Database.php");
        $oldimgsql = "SELECT image FROM $this->tablename WHERE id =$id";
        $oldimg = $conn->query($oldimgsql);
        $result = $oldimg->fetchAll(PDO::FETCH_ASSOC);
        $check = $result[0]['image'];
        
        //store product info in the database
        $sql = "UPDATE $this->tablename SET agent='$this->email',title = '$title',location = '$location',description = '$info',image = '$imagedir',price = '$price' WHERE id='$id'";
            if($conn->exec($sql)==1){
                //delete image
                $unlink = unlink($check);
                //move image to image folder
                move_uploaded_file($tempname,$imagedir);
                $data = 1;
                echo json_encode($data);
            }else{
                $data = 0;
                echo json_encode($data);
            }
    }
    public function removeproduct($id){
        require('../Inc/Database.php');
        $oldimgsql = "SELECT image FROM $this->tablename WHERE id =$id";
        $oldimg = $conn->query($oldimgsql);
        $result = $oldimg->fetchAll(PDO::FETCH_ASSOC);
        $check = $result[0]['image'];
        $sql = "DELETE FROM $this->tablename WHERE id='$id'";
        //delete whole row in the db
        if($conn->exec($sql)==1){
            //delete image
            $unlink = unlink($check);
            //send success response
            $data = 1;
            echo json_encode($data);
        }else{
            //send fail response
            $data = 0;
            echo json_encode($data);
        }
    }
    public function notification($agent){
        //get all negotiations where agents is agent
        require('../Inc/Database.php');
        $sql = "SELECT * FROM negotiations WHERE agent='$agent'";
        $nsql = "SELECT notification FROM $this->tablename WHERE email='$agent'";
        $notification = $conn->query($nsql);
        $notification = $notification->fetchAll(PDO::FETCH_ASSOC);
        $notification = $notification[0]['notification'];
        //
        $negotiations = $conn->query($sql);
        $negotiations =array_reverse($negotiations->fetchAll(PDO::FETCH_ASSOC));
        $old = $notification;
        $new = count($negotiations);
        //logic to decide whether there is a new notification
        if($new>0){
            if($new>$old){
                $data = array();
                $data['negotiations'] = $negotiations;
                $data['new'] = true;
                echo json_encode($data);
                $updatesql = "UPDATE $this->tablename SET notification='$new' WHERE email='$agent'";
                $update = $conn->exec($updatesql);
            }else{
                $data = array();
                $data['negotiations'] = $negotiations;
                $data['new'] = false;
                echo json_encode($data);
            }
          
        }else{
            $data = 0;
            echo json_encode($data);
        }
        //
    }
}


?>