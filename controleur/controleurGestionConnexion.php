<?php
include("../modele/dao/dbConnex.php");
include("../modele/dao/param.php");
$connexion = DBConnex::getInstance();

if(!empty($_POST['login']) && !empty($_POST['mdp']) && isset($_POST['mdp']) && isset($_POST['login'])){
    $login = htmlspecialchars(strip_tags($_POST['login']));
    $mdp = htmlspecialchars(strip_tags($_POST['mdp']));
    //$mdp = password_hash($Password, PASSWORD_ARGON2I, ['cost' => 12]);
    if(DBConnex::verifLogin($connection, $login) == True){
        if(password_verify($mdp, DBConnex::verifMdp($connection, $login))){
            
        }
        else{
            $messageErreurConnexion = "Le nom d'utilisateur ou le mot de passe sont incorrects !";
        }
    }
    else{
        $messageErreurConnexion = "Le nom d'utilisateur ou le mot de passe sont incorrects !";
    }
}
else{
    $messageErreurConnexion = "Tous les champs doivent être remplis !";
}