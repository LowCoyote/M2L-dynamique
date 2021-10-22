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
    if(isset($_POST['login']) && isset($_POST['mdp']))
    {
        if(UtilisateurDAO::verification($_POST['login'], $_POST['mdp']))
        {
            $user = new UtilisateurDTO();
            $user->hydrate(UtilisateurDAO::getUtilisateur($_POST['login']));

            $_SESSION['identification'] = $user;
            if(!empty($_SESSION['identification']) )
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

                if($_SESSION['identification']->getIdFonct()=="3")
                {
                    $_SESSION['m2lMP']="responsable";
                }
                elseif ($_SESSION['identification']->getIdFonct()=="4")
                {
                    $_SESSION['m2lMP']="secrétaire";
                }
                if($_SESSION['identification']->getIdFonct()=="5")
                {
                    $_SESSION['m2lMP']="responsablef";
                }


            }
        }
        else
        {
            $messageErreurConnexion = "Le mot de passe ou le login est incorrect";
        }
    }
} // Connection

//Debut Valentin
else if(isset($_POST['submitFInscFormation']) ) {

    $idUser = $_SESSION['identification']->getIdUser();

    if (isset($_POST['idForma']))
    {
        EffectueDAO::effectuerDemandeForma($_POST['idForma'], $idUser);
    }
    else
    {
        echo('<script>alert("Echec lors de l&rsquo;inscription a la formation !!");</script>');
    }

} // inscription a une formation
else if(isset($_POST['submitFDesiFormation']) ) {

    $idUser = $_SESSION['identification']->getIdUser();

    if (isset($_POST['idForma']))
    {
        EffectueDAO::supprimerDemandeForma($_POST['idForma'], $idUser);
    }
    else
    {
        echo('<script>alert("Echec lors de l&rsquo;annulation de l&rsquo;inscription de la formation !!");</script>');
    }
} // anuler l'inscription d'une formation

else if(isset($_POST['submitNewForma']) ) {

    if (isset($_POST['intitule'],$_POST['descriptif'],$_POST['duree'],$_POST['dateOuvertureInscription'],$_POST['dateClotureInscription'],$_POST['effectifMax']))
    {
        FormationDAO::nouvelleFormation($_POST['intitule'],$_POST['descriptif'],$_POST['duree'],$_POST['dateOuvertureInscription'],$_POST['dateClotureInscription'],$_POST['dateDebut'], $_POST['dateFin'], $_POST['effectifMax']);
        //   $_SESSION['MenuResponsablef']="succes";
        //  $_SESSION['message']="La nouvelle formation a bien ete ajouter";
        echo("<script>alert('La nouvelle formation a bien ete ajouter');</script>");
        $_SESSION['m2lMP']="formations";
    }
    else
    {
       echo("<script>alert('Echec lors de la creation de la nouvelle formation !!');</script>");
    }
} // Ajout d'une nouvelle formation
else if(isset($_POST['submitEditForma']) ) {

    if (isset($_POST['intitule'],$_POST['descriptif'],$_POST['duree'],$_POST['dateOuvertureInscription'],$_POST['dateClotureInscription'],$_POST['effectifMax']))
    {
        FormationDAO::modifierFormation($_POST['idForma'],$_POST['intitule'],$_POST['descriptif'],$_POST['duree'],$_POST['dateOuvertureInscription'],$_POST['dateClotureInscription'],$_POST['effectifMax']);

        echo("<script>alert('La formation a bien ete modifier');</script>");
        $_SESSION['m2lMP']="formations";
    }
    else
    {
        echo("<script>alert('Echec lors de la modification de la formation !!');</script>");
    }
} // modification d'une formation

else if(isset($_POST['submitAccepterDemande']) ) {

    if (isset($_POST['idForma']) && isset($_POST['idUser']))
    {
        EffectueDAO::accepterDemandeForma($_POST['idForma'], $_POST['idUser']);
    }
    else
    {
        echo("<script>alert('nope');</script>");
    }

} // accepter la demande d'inscription a une formation
else if(isset($_POST['submitRefuserDemande']) ) {

    if (isset($_POST['idForma']) && isset($_POST['idUser']))
    {
        EffectueDAO::refuserDemandeForma($_POST['idForma'], $_POST['idUser']);
    }
    else
    {
        echo("<script>alert('nope');</script>");
    }
} // refuser la demande d'inscription a une formation

//Fin Valentin


//Debut Antoine
else if(isset($_POST['submitNewLigue']) ) {

    if (isset($_POST['nom'],$_POST['site'],$_POST['descriptif']))
    {
        LigueDAO::nouvelleLigue($_POST['nom'],$_POST['site'],$_POST['descriptif']);
        echo("<script>alert('La nouvelle Ligue a bien ete ajouter');</script>");
        $_SESSION['m2lMP']="ligues";
    }
    else
    {
        echo("<script>alert('Echec lors de la creation de la nouvelle Ligue !!');</script>");
    }
} // Ajout d'une nouvelle Ligue
else if(isset($_POST['submitEditLigue']) ) {

    if (isset($_POST['idLigue'],$_POST['nom'],$_POST['site'],$_POST['descriptif']))
    {
        LigueDAO::modifierLigue($_POST['idLigue'],$_POST['nom'],$_POST['site'],$_POST['descriptif']);

        echo("<script>alert('La Ligue a bien ete modifier');</script>");
        $_SESSION['m2lMP']="ligues";
    }
    else
    {
        echo("<script>alert('Echec lors de la modification de la Ligue !!');</script>");
    }
} // modification d'une Ligue

//Fin Antoine

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
    if($_SESSION['identification']->getStatut()=="salarié"){
        $m2lMP->ajouterComposant($m2lMP->creerItemLien("salarie","Salarie"));
    }
    elseif($_SESSION['identification']->getStatut()=="responsableF" ){
        $m2lMP->ajouterComposant($m2lMP->creerItemLien("formations", "Formations"));
        $m2lMP->ajouterComposant($m2lMP->creerItemLien("responsablef","ResponsableF"));
    }
    elseif($_SESSION['identification']->getIdFonct()=="3"){
        $m2lMP->ajouterComposant($m2lMP->creerItemLien("responsable","ResponsableRH"));
    }
    elseif ($_SESSION['identification']->getStatut()=="bénévole")
    {
        $m2lMP->ajouterComposant($m2lMP->creerItemLien("formations", "Formations"));
        $m2lMP->ajouterComposant($m2lMP->creerItemLien("responsablef", "ResponsableF"));
        $m2lMP->ajouterComposant($m2lMP->creerItemLien("benevole","Benevole"));
    }
    elseif ($_SESSION['identification']->getStatut()=="secrétaire")
    {
        $m2lMP->ajouterComposant($m2lMP->creerItemLien("secrétaire", "Secretaire"));
    }
    $m2lMP->ajouterComposant($m2lMP->creerItemLien("deconnexion", "Deconnexion"));

}



$menuPrincipalM2L = $m2lMP->creerMenu($_SESSION['m2lMP'],'m2lMP');


include_once dispatcher::dispatch($_SESSION['m2lMP']);




