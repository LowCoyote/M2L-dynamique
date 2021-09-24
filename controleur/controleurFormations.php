<?php
/*****************************************************************************************************
 * Instancier un objet contenant la liste des Equipes et le conserver dans une variable de session
 *****************************************************************************************************/
$_SESSION['listFormations'] = new FormationsDTO(FormationDAO::lesFormations());

if(isset($_GET['MenuFormation'])){
    $_SESSION['MenuFormation']= $_GET['MenuFormation'];
}
else
{
    if(!isset($_SESSION['MenuFormation'])){
        $_SESSION['MenuFormation']="1";
    }
}

// Créer un menu vertical

$menuFormation = new menu("menuFormation");

foreach ($_SESSION['listFormations']->getFormations() as $uneFormation){
    $menuFormation->ajouterComposant($menuFormation->creerItemLien($uneFormation->getIdForma() ,$uneFormation->getIntitule()));
}

$leMenuFormations = $menuFormation->creerMenu2($_SESSION['MenuFormation'],'MenuFormation' , "Les Formations");


// Récupérer l'équipe sélectionnée
$formationActive = $_SESSION['listFormations']->chercheFormation($_SESSION['MenuFormation']);
//var_dump($formationActive);

//formation
$lablID = $formationActive->getIdForma();
$lablIntitule = $formationActive->getIntitule();
$lablDescriptif= $formationActive->getDescriptif();

$labdateOuvertureInscription= $formationActive->getDateOuvertureInscription();
$labdateClotureInscription = $formationActive->getDateClotureInscription();
$lableffectifMax = $formationActive->getEffectifMax();


$idUser = $_SESSION['identification']->getIdUser();


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





$unformulaire = new Formulaire("post", "index.php", "fInscFormation", "form");

//$unformulaire->ajouterComposantLigne($unformulaire->creerID("anchor",$lablID,  ""), "1");

$unformulaire->ajouterComposantLigne($unformulaire->creerTitre("titre",  "Intitule :".$lablIntitule.""),"1");


$unformulaire->ajouterComposantLigne($unformulaire->creerCorp("corps",$lablDescriptif), "1");


$extra = "formation entre : ".$labdateOuvertureInscription." et ".$labdateClotureInscription." effectif max : ".$lableffectifMax."";

$unformulaire->ajouterComposantLigne($unformulaire->creerCorp("corps",$extra), "1");

$unformulaire->ajouterComposantLigne($unformulaire-> creerInputSubmit2('submitConnex', 'submitConnex', "S&rsquo;inscrie a cétte formation"));
$unformulaire->ajouterComposantTab();


$unformulaire->creerArticle();

require_once 'vue/vueFormations.php';
