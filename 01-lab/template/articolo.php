<?php
require_once("bootstrap.php");

$templateparams["titolo"] = "Blog TW - Articolo";
$templateparams["nome"]  = "singolo-articolo.php";
$templateparams["articolicasuali"] = $dbh->getRandomPost(2);
$templateparams["categorie"] = $dbh->getCategories();

$idarticolo = -1;
if(isset($_GET["id"])){
    $idarticolo = $_get["ID"];
}

require("template/base.php");

?>