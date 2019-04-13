<?php
class Pbc{
    //Get all feeds
    public function getfeeds(){
        require('../Inc/Database.php');
        $sql = "SELECT * FROM spaces WHERE status='available'";
        $result = $conn->query($sql);
        $resultarray = array_reverse($result->fetchAll(PDO::FETCH_ASSOC));
        echo json_encode($resultarray);
    }
    public function getfeed($id){
        require('../Inc/Database.php');
        $sql = "SELECT * FROM spaces WHERE id ='$id' and status='available'";
        $result = $conn->query($sql);
        $resultarray = $result->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultarray);
    }
    public function notifyagent($id,$name,$number,$user){
        require('../Inc/Database.php');
        //get agent
        $sql = "SELECT agent FROM spaces WHERE id ='$id'";
        $result = $conn->query($sql);
        $show = $result->fetchAll(PDO::FETCH_ASSOC);
        $agent = $show[0]['agent'];
        $titlesql = "SELECT title FROM spaces WHERE id='$id'";
        $title = $conn->query($titlesql);
        $title = $title->fetchAll(PDO::FETCH_ASSOC);
        $title = $title[0]['title'];
        //add agent name, product and user info to the notify table
        $addsql = "INSERT INTO negotiations (customer,mobile,title,productid,agent,user)
         VALUES ('$name','$number','$title','$id','$agent','$user')";
         $insert = $conn->exec($addsql);
         if($insert == 1){
             $data = 1;
             echo json_encode($data);
         }
         else{
             $data = $user;
             echo json_encode($data);
         }
    }
    public function getHistory($email){
        require('../Inc/Database.php');
        $Historysql = "SELECT * FROM negotiations WHERE user='$email'";
        $History = $conn->query($Historysql);
        $History = $History->fetchAll(PDO::FETCH_ASSOC);
        $History = array_reverse($History);

        if(count($History)>0){
            $data = $History;
            echo json_encode($data);
        }else{
            $data = 0;
            echo json_encode($data);
        }

    }
    public function updateProductStatus($id){
        require('../Inc/Database.php');
        $updatesql = "UPDATE spaces SET status='sold' WHERE id='$id'";
        $update = $conn->exec($updatesql);
        if($update == 1){
            $data = 1;
            echo json_encode($data);
        }else{
            $data = 0;
            echo json_encode($data);
        }

    }

}
?>