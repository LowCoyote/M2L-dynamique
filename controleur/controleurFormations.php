<?php

// Instancier un objet contenant la liste des Formations et le conserver dans une variable de session
$_SESSION['listFormations'] = new FormationsDTO(FormationDAO::lesFormations());

if(isset($_GET['MenuFormation'])){
    $_SESSION['MenuFormation']= $_GET['MenuFormation'];
}
else
{
    if(!isset($_SESSION['MenuFormation'])){
        $_SESSION['MenuFormation']=null;
    }
}

$date = date('Y-m-d');

$menuFormation = new menu("menuFormation");

if ($_SESSION['listFormations']!=null)
{
    foreach ($_SESSION['listFormations']->getFormations() as $uneFormation){
        if ($date >= $uneFormation->getDateOuvertureInscription() && $date <= $uneFormation->getDateClotureInscription())
        {
            $menuFormation->ajouterComposant($menuFormation->creerItemLien($uneFormation->getIdForma() ,$uneFormation->getIntitule()));
        }
    }
}

$leMenuFormations = $menuFormation->creerMenu2($_SESSION['MenuFormation'],'MenuFormation' , "Les Formations");

if ($_SESSION['listFormations']->getFormations()!=null)
{
    // Récupérer l'équipe sélectionnée
    $formationActive = $_SESSION['listFormations']->chercheFormation($_SESSION['MenuFormation']);
}

if (isset($formationActive))
{
    $idForma= $formationActive->getIdForma();
    $lablIntitule = $formationActive->getIntitule();
    $lablDescriptif= $formationActive->getDescriptif();
    $duree = $formationActive->getDuree(); //if faut ou pas ????
    $labdateOuvertureInscription= $formationActive->getDateOuvertureInscription();
    $labdateClotureInscription = $formationActive->getDateClotureInscription();
    $dateDebut= $formationActive->getDateDebut();
    $dateFin = $formationActive->getDateFin();
    $lableffectifMax = $formationActive->getEffectifMax();


    $idUser = $_SESSION['identification']->getIdUser();


    $_SESSION['demandeInscription'] = FormationDAO::verifierDemandeInscrit($idForma, $idUser);


    if ($_SESSION['demandeInscription']==false)
    {
        $unformulaire = new Formulaire("post", "index.php", "fInscFormation", "form");

        $unformulaire->ajouterComposantLigne($unformulaire->creerID("idForma",$idForma,  ""), "WW");

        $unformulaire->ajouterComposantLigne($unformulaire->creerTitre("titre",  "Intitule :".$lablIntitule.""),"1");


        $unformulaire->ajouterComposantLigne($unformulaire->creerCorp("corps",$lablDescriptif), "1");
/*

        $extra = "formation entre : ".$labdateOuvertureInscription." et ".$labdateClotureInscription." effectif max : ".$lableffectifMax."";

        $unformulaire->ajouterComposantLigne($unformulaire->creerCorp("corps",$extra), "1");
*/

        $data = array (
            array("Duree : ",$duree,'heurs'),
            array("Effectif Max :",$lableffectifMax,'personnes'),
            //Ouverture //Cloture
            array("-",'Ouverture','Cloture'),
            array("Inscription :",$labdateOuvertureInscription,$labdateClotureInscription),
            //Debut //Fin
            array("-",'Debut','Fin'),
            array("Formation :",$dateDebut, $dateFin),
            array("Etat inscription :",'PAS INSCRIT','-')
        );

        $tabDetailsForma = new Tableau(1,$data);
        $tabDetailsForma->setTitreTab("Details Formation");


        $unformulaire->ajouterComposantLigne($unformulaire-> creerInputSubmit2('submitFInscFormation', 'submitFInscFormation', "S&rsquo;inscrie a cétte formation"));
        $unformulaire->ajouterComposantTab();


        $unformulaire->creerArticle();

    } // formulaire d'inscription
    else
    {
        $unformulaire = new Formulaire("post", "index.php", "fDesiFormation", "form");

        $unformulaire->ajouterComposantLigne($unformulaire->creerID("idForma",$idForma,  ""), "1");

        $unformulaire->ajouterComposantLigne($unformulaire->creerTitre("titre",  "Intitule :".$lablIntitule.""),"1");

        $unformulaire->ajouterComposantLigne($unformulaire->creerCorp("corps",$lablDescriptif), "1");

/*
        $extra = "formation entre : ".$labdateOuvertureInscription." et ".$labdateClotureInscription." effectif max : ".$lableffectifMax."";

        $unformulaire->ajouterComposantLigne($unformulaire->creerCorp("corps",$extra), "1");
*/

      /*  $extra2 = "Etat inscription : ".$_SESSION['demandeInscription']['EtatInscription']
            . " | Date Inscription : " . $_SESSION['demandeInscription']['DateInscription'];
        $unformulaire->ajouterComposantLigne($unformulaire->creerCorp("corps",$extra2), "1");*/

        $data = array (
            array("Duree : ",$duree,'heurs'),
            array("Effectif Max :",$lableffectifMax,'personnes'),
            //Ouverture //Cloture
            array("-",'Ouverture','Cloture'),
            array("Inscription :",$labdateOuvertureInscription,$labdateClotureInscription),
            //Debut //Fin
            array("-",'Debut','Fin'),
            array("Formation :",$dateDebut, $dateFin),
            array("Etat inscription :",$_SESSION['demandeInscription']['EtatInscription'],'-')
        );

        $tabDetailsForma = new Tableau(1,$data);
        $tabDetailsForma->setTitreTab("Details Formation");

        $unformulaire->ajouterComposantLigne($unformulaire-> creerInputSubmit2('submitFDesiFormation', 'submitFDesiFormation', " Annuler l&rsquo;inscription "));
        $unformulaire->ajouterComposantTab();


        $unformulaire->creerArticle();
    } // formulaire d'anulation de l'inscription

} // formation active
else
{
    $message = "Pas de formations disponible !";
}

require_once 'vue/vueFormations.php';
