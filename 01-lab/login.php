<?php 
require_once("bootstrap.php");

if(isset($_POST["username"]) && isset($_POST["password"])){
    $login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);

    if(count($login_result)==0){
        //Login fallisto
        $templateparams["errorelogin"] = "Errore! Verificare username e(o password";
        } 
    esle {
        registerLoggedUser($login_result[0]);
    }
}

if(isUserLoggedIn()){
    $templateparams["titolo"] = "Blog TW - Admin";
    $templateparams["nome"] = "login-home.php";
    $templateparams["articoli"] = $dbh->getPostByauthorID($_SESSION["idautore"]);

    if(isset($_GET["formmsg"])){
        $templateparams["formmsg"] = $_GET["formmsg"];
    }
}

else {
    $templateparams["titolo"] = "Blog TW - Login";
    $templateparams["nome"] = "login-form.php"
}

$templateparams["categorie"] = $dbh->getCategories();
$templateparams["articolicasuali"] = $dbh->getRandomPost(2);


require("template/base.php");
?>