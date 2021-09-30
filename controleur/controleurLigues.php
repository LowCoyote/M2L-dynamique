<?php
/*****************************************************************************************************
 * Instancier un objet contenant la liste des Equipes et le conserver dans une variable de session
 *****************************************************************************************************/
$_SESSION['listLigues'] = new LiguesDTO(LigueDAO::lesLigues());

if(isset($_GET['MenuLigue'])){
    $_SESSION['MenuLigue']= $_GET['MenuLigue'];
}
else
{
    if(!isset($_SESSION['MenuLigue'])){
        $_SESSION['MenuLigue']="1";
    }
}

// Créer un menu vertical

$menuLigue = new menu("gg"); //sidenav

foreach ($_SESSION['listLigues']->getLigues() as $uneLigue){
    $menuLigue->ajouterComposant($menuLigue->creerItemLien($uneLigue->getIdLigue() ,$uneLigue->getNomLigue()));
}

$leMenuLigus = $menuLigue->creerMenu2($_SESSION['MenuLigue'],'MenuLigue' , "Les Ligues");


// Récupérer l'équipe sélectionnée
$formationActive = $_SESSION['listLigues']->chercheLigue($_SESSION['MenuLigue']);
//var_dump($formationActive);
/*
//formation
$lablID = $formationActive->getIdForma();
$lablIntitule = $formationActive->getIntitule();
$lablDescriptif= $formationActive->getDescriptif();

$labdateOuvertureInscription= $formationActive->getDateOuvertureInscription();
$labdateClotureInscription = $formationActive->getDateClotureInscription();
$lableffectifMax = $formationActive->getEffectifMax();


$idUser = $_SESSION['identification']->getIdUser();*/


///////to do
//if (verifierInscrit($formID, ) == 0)
//{
//  afficher formulairse avec le STATUS de la demade de formation et le button se desiscrire
//formulaire desinscription : fDesiFormation
//}
//else
//{
//afficher formulairse s'inscrire (bouton s'inscrire)
//formulaire inscription : fInscFormation
//}




/*
$unformulaire = new Formulaire("post", "index.php", "fInscFormation", "form");

//$unformulaire->ajouterComposantLigne($unformulaire->creerID("anchor",$lablID,  ""), "1");

$unformulaire->ajouterComposantLigne($unformulaire->creerTitre("titre",  "Intitule :".$lablIntitule.""),"1");


$unformulaire->ajouterComposantLigne($unformulaire->creerCorp("corps",$lablDescriptif), "1");


$extra = "formation entre : ".$labdateOuvertureInscription." et ".$labdateClotureInscription." effectif max : ".$lableffectifMax."";

$unformulaire->ajouterComposantLigne($unformulaire->creerCorp("corps",$extra), "1");

$unformulaire->ajouterComposantLigne($unformulaire-> creerInputSubmit2('submitConnex', 'submitConnex', "S&rsquo;inscrie a cétte formation"));
$unformulaire->ajouterComposantTab();


$unformulaire->creerArticle();*/

require_once 'vue/vueLigues.php' ;
