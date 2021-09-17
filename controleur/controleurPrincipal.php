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
if(isset($_POST['login']) && isset($_POST['mdp']))
{
	if(UtilisateurDAO::verification($_POST['login'], $_POST['mdp']))
	{
        $user = new UtilisateurDTO();
        $user->hydrate(UtilisateurDAO::getUtilisateur($_POST['login']));

        $_SESSION['identification'] = $user;
        if(!empty($_SESSION['identification']) )
        {
            if ($_SESSION['identification']->getIdFonct()=="1")
            {
                $_SESSION['m2lMP']="formations";
            }


        }
    }
	else
	{
		$messageErreurConnexion = "Le mot de passe ou le login est incorrect";
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
    if ($_SESSION['identification']->getIdFonct()=="1")
    {
        $m2lMP->ajouterComposant($m2lMP->creerItemLien("formations", "formations"));
    }
}


$menuPrincipalM2L = $m2lMP->creerMenu($_SESSION['m2lMP'],'m2lMP');


include_once dispatcher::dispatch($_SESSION['m2lMP']);




