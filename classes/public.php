<?php
class Pbc{
    //Get all feeds
    public function getfeeds(){
        require('../Inc/Database.php');
        $sql = 'SELECT * FROM spaces';
        $result = $conn->query($sql);
        $resultarray = array_reverse($result->fetchAll(PDO::FETCH_ASSOC));
        echo json_encode($resultarray);
    }
    public function getfeed($id){
        require('../Inc/Database.php');
        $sql = "SELECT * FROM spaces WHERE id ='$id'";
        $result = $conn->query($sql);
        $resultarray = $result->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultarray);
    }
    public function notifyagent(){
        //add user info and the product to the notice table of the agent to
        
    }

    public function addtohistory(){

    }
}
?>