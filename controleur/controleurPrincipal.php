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
        if(!empty($_SESSION['identification']))
        {
            if($_SESSION['identification']->getIdFonct()=="1")
            {
                if($_SESSION['identification']->getStatut()=="salarié")
                {
                    $_SESSION['m2lMP']="salarie";
                }
                else
                {
                    $_SESSION['m2lMP']="benevole";
                }
            }
            if($_SESSION['identification']->getIdFonct()=="2")
            {
                $_SESSION['m2lMP']="services";
            }
            if($_SESSION['identification']->getIdFonct()=="3")
            {
                $_SESSION['m2lMP']="services";
            }
            if($_SESSION['identification']->getIdFonct()=="4")
            {
                $_SESSION['m2lMP']="services";
            }
            if($_SESSION['identification']->getIdFonct()=="5")
            {
                $_SESSION['m2lMP']="services";
            }           
        }
        else
        {
            $_SESSION['m2lMP']="accueil";
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



if(!isset($_SESSION['identification']) || !$_SESSION['identification'])
{
    $m2lMP->ajouterComposant($m2lMP->creerItemLien("connexion", "Connexion"));
}
else
{
    if($_SESSION['identification']->getStatut()=="salarié"){
        $m2lMP->ajouterComposant($m2lMP->creerItemLien("salarie","Salarie"));
    }
    elseif($_SESSION['identification']->getStatut()=="bénévole")
    {
        $m2lMP->ajouterComposant($m2lMP->creerItemLien("benevole","Benevole"));
    }
    $m2lMP->ajouterComposant($m2lMP->creerItemLien("deconnexion", "Deconnexion"));
}


$menuPrincipalM2L = $m2lMP->creerMenu($_SESSION['m2lMP'],'m2lMP');


include_once dispatcher::dispatch($_SESSION['m2lMP']);




