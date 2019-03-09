<?php
class Pbc{
    //Get all feeds
    public function getfeeds(){
        require('../Inc/Database.php');
        $sql = 'SELECT * FROM userdetails';
        $result = $conn->query($sql);
        $resultarray = array_reverse($result->fetchAll(PDO::FETCH_ASSOC));
        echo json_encode($resultarray);
    }
}
?>