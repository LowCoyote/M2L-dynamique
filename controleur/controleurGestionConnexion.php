<?php
$connexion = DBConnex::getInstance();

//Vérification des login et du mot de passe
if(!empty($_POST['login']) && !empty($_POST['mdp']) && isset($_POST['mdp']) && isset($_POST['login'])){
    $login = htmlspecialchars(strip_tags($_POST['login']));
    $mdp = htmlspecialchars(strip_tags($_POST['mdp']));
    $_utilisateur = new UtilisateurDTO($login, $mdp);
    if(isset(UtilisateurDAO::verification($_utilisateur))){
        $_SESSION['identification'] = UtilisateurDAO::verification($_utilisateur);
        var_dump($_SESSION['identification']);
    }
    else{
        $messageErreurConnexion = "Le nom d'utilisateur ou le mot de passe sont incorrects !";
    }
}
else{
    $messageErreurConnexion = "Tous les champs doivent être remplis !";
}