<?php
if(isset($_GET['m2lMP'])){
	$_SESSION['m2lMP']= $_GET['m2lMP'];
}
else
{
	if(!isset($_SESSION['m2lMP'])){
		$_SESSION['m2lMP']="accueil";
	}
}

$messageErreurConnexion = '';
if(isset($_POST['login']) )
{

    $_utilisateur = new UtilisateurDTO($_POST['login'], $_POST['mdp']);
    $_SESSION['identification'] = UtilisateurDAO::verification($_utilisateur);


    if($_SESSION['identification'])
    {
        $_SESSION['m2lMP']="accueil";
    }
    else
    {
        $_SESSION['identification'] = [];
        $messageErreurConnexion = 'Login ou mot de passe invalide.';
    }
}

$m2lMP = new Menu("m2lMP");

$m2lMP->ajouterComposant($m2lMP->creerItemLien("accueil", "Accueil"));
$m2lMP->ajouterComposant($m2lMP->creerItemLien("services", "Services"));
$m2lMP->ajouterComposant($m2lMP->creerItemLien("locaux", "Locaux"));
$m2lMP->ajouterComposant($m2lMP->creerItemLien("ligues", "Ligues"));
//$m2lMP->ajouterComposant($m2lMP->creerItemLien("connexion", "Se connecter"));


if(!isset($_SESSION['identification']) || !$_SESSION['identification'])
{
    $m2lMP->ajouterComposant($m2lMP->creerItemLien("connexion", "Connexion"));
}
else
{
    $m2lMP->ajouterComposant($m2lMP->creerItemLien("deconnexion", "Deconnexion"));
}


$menuPrincipalM2L = $m2lMP->creerMenu($_SESSION['m2lMP'],'m2lMP');


include_once dispatcher::dispatch($_SESSION['m2lMP']);




