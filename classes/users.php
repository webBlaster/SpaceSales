<?php

class Users{
    
    function __construct($email,$password,$tablename,$authurl,$accesspage){
        $this->email = $email;
        $this->password = $password;
        $this->tablename = $tablename;
        $this->authurl = $authurl;
        $this->accesspage = $accesspage;
    }

    //testing basically
    public function test(){
        $response = $this->email;
        echo "am working";
    }
    //Checks if the User exist.. it notifies if it does with a message 
    //Else it registers the new user
    public function register(){
        $checksql = "SELECT * FROM $this->tablename WHERE email = '$this->email'";
            require("../Inc/Database.php");
            $checker = $conn->query($checksql);
            if($checker->rowcount()>0){
                    $response = 0;
                    echo json_encode($response);
            }else{
                    $SQL = "INSERT INTO $this->tablename (email,password) VALUES ('$this->email','$this->password')";
                    $conn->exec($SQL);
                    $responseclone = "/SpaceSales/view/spacefeeds.html";
                    $response = $this->accesspage;
                    echo json_encode($response);
                }
                   
    }
    //authenticates a user
    public function Login(){
        require("../Inc/Database.php");
        $checksql = "SELECT * FROM $this->tablename WHERE email = '$this->email' AND password = '$this->password'";
        $checker = $conn->query($checksql);

        if($checker->rowcount()>0){
            $data = $this->accesspage;
            session_start();
            $_SESSION['auth']=true;
            $_SESSION['email']= $this->email;
            echo json_encode($data);

        }else{
            $data = 0;
            echo json_encode($data);
        }        
    }
    //logs out a user by destroying the session variables
    public function Logout(){
        require('../inc/Config.php');
        session_start();
        session_unset();
        session_destroy();
        header('location:http://'.DB_HOST.$this->authurl);
    }
    //checks authentication status if logged in or out
    public function Authstatus(){
        session_start();
        if(isset($_SESSION['auth'])){
            $response = 1;
            echo json_encode($response);
        }
        else{
            $response = 0;
            echo json_encode($response);
        }
    }

}

?>