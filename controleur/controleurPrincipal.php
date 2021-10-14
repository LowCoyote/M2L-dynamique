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



if(isset($_POST['submitConnex']) ) {

}
else if(isset($_POST['submitFInscFormation']) ) {

    $idUser = $_SESSION['identification']->getIdUser();

   // var_dump($idUser);
    if (isset($_POST['idForma']))
    {
        EffectueDAO::effectuerDemandeForma($_POST['idForma'], $idUser);
    }
    else
    {
        echo("<script>alert('nope');</script>");
    }

}
else if(isset($_POST['submitFDesiFormation']) ) {

    $idUser = $_SESSION['identification']->getIdUser();

    if (isset($_POST['idForma']))
    {
        EffectueDAO::supprimerDemandeForma($_POST['idForma'], $idUser);
    }
    else
    {
        echo("<script>alert('nope');</script>");
    }
}

else if(isset($_POST['submitNewForma']) ) {

    if (isset($_POST['intitule'],$_POST['descriptif'],$_POST['duree'],$_POST['dateOuvertureInscription'],$_POST['dateClotureInscription'],$_POST['effectifMax']))
    {
        FormationDAO::nouvelleFormation($_POST['intitule'],$_POST['descriptif'],$_POST['duree'],$_POST['dateOuvertureInscription'],$_POST['dateClotureInscription'],$_POST['effectifMax']);
        $_SESSION['m2lMP']="responsablef";
        //   $_SESSION['MenuResponsablef']="succes";
        //  $_SESSION['message']="La nouvelle formation a bien ete ajouter";
    }
    else
    {
     //  echo("<script>alert('nope');</script>");
    }
}

else if(isset($_POST['submitEditForma']) ) {

    if (isset($_POST['intitule'],$_POST['descriptif'],$_POST['duree'],$_POST['dateOuvertureInscription'],$_POST['dateClotureInscription'],$_POST['effectifMax']))
    {

        FormationDAO::modifierFormation($_POST['idForma'],$_POST['intitule'],$_POST['descriptif'],$_POST['duree'],$_POST['dateOuvertureInscription'],$_POST['dateClotureInscription'],$_POST['effectifMax']);
    }
    else
    {
        echo("<script>alert('nope');</script>");
    }
}

else if(isset($_POST['submitAccepterDemande']) ) {

    if (isset($_POST['idForma']) && isset($_POST['idUser']))
    {
        EffectueDAO::accepterDemandeForma($_POST['idForma'], $_POST['idUser']);
    }
    else
    {
        echo("<script>alert('nope');</script>");
    }

}
else if(isset($_POST['submitRefuserDemande']) ) {

    if (isset($_POST['idForma']) && isset($_POST['idUser']))
    {
        EffectueDAO::refuserDemandeForma($_POST['idForma'], $_POST['idUser']);
    }
    else
    {
        echo("<script>alert('nope');</script>");
    }
}




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

    if ($_SESSION['identification']->getIdFonct()=="1" && $_SESSION['identification']->getStatut()=="benevole")
    {
        $m2lMP->ajouterComposant($m2lMP->creerItemLien("formations", "Formations"));
        $m2lMP->ajouterComposant($m2lMP->creerItemLien("responsablef", "ResponsableF"));
    }
    $m2lMP->ajouterComposant($m2lMP->creerItemLien("deconnexion", "Deconnexion"));
}


$menuPrincipalM2L = $m2lMP->creerMenu($_SESSION['m2lMP'],'m2lMP');


include_once dispatcher::dispatch($_SESSION['m2lMP']);




