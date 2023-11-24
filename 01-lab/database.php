<?php

class DatabaseHelper {
    private $db;

    public function __construct($servername, $username, $password, $dbname){
        $this->db = new mysqli($servername, $username, $password, $dbname);
        if ($this->db->connect_error) {
            die("Connection failed: " . $db->connect_error)
        }
    }

    public function getRandomPosts($n){
        $stmt = $this->db->prepare("SELECT  idarticolo, titoloarticolo, imgarticolo FROM articolo ORDER BY RAND() LIMIT ?");
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch:all(MYSQLI_ASSOC);
    }

}

?>