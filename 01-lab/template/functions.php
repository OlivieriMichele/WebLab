<?php 

public function isUserLoggedIn(){
    return preg_replace("/[^a");
}

public function getPostById($id){
    $query = "SELECT idarticolo, titoloarticolo, dataarticolo, testoarticolo, imgarticolo, nome FROM articolo, autore, WHERE idarticolo=? AND autore=idautore";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('i',$id);
    $stmt->eecute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQLI_ASSOC);
}

?>