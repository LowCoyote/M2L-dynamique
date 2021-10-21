<?php
/*****************************************************************************************************
 * Instancier un objet contenant la liste des Equipes et le conserver dans une variable de session
 *****************************************************************************************************/
$_SESSION['listLigues'] = new LiguesDTO(LigueDAO::lesLigues());
$_SESSION['listClubs'] = new ClubsDTO(ClubDAO::lesClubs());

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

$menuLigue = new menu("gg"); 

foreach ($_SESSION['listLigues']->getLigues() as $uneLigue){
    $menuLigue->ajouterComposant($menuLigue->creerItemLien($uneLigue->getIdLigue() ,$uneLigue->getNomLigue()));
}

$leMenuLigues = $menuLigue->creerMenu2($_SESSION['MenuLigue'],'MenuLigue' , "Les Ligues");

// Récupérer la ligue sélectionnée et le club affilié

$ligueActive = $_SESSION['listLigues']->chercheLigue($_SESSION['MenuLigue']);
$clubActif = $_SESSION['listClubs'];

// Ligue, clubs
$lablID = $ligueActive->getIdLigue();
$lablIntitule = $ligueActive->getNomLigue();
$lablSite= $ligueActive->getSite();
$lablDescriptif= $ligueActive->getDescriptif();



$unformulaire = new Formulaire("post", "index.php", "formLigues", "form");

$unformulaire->ajouterComposantLigne($unformulaire->creerID("anchor",$lablID,  ""), "1");

$unformulaire->ajouterComposantLigne($unformulaire->creerTitre("titre",$lablIntitule),"1");

$unformulaire->ajouterComposantLigne($unformulaire->creerCorp("corps","Site internet : ".$lablSite), "1");

$unformulaire->ajouterComposantLigne($unformulaire->creerCorp("corps",$lablDescriptif), "1");

$data1 = array ();
foreach($clubActif->getClubs() as $club)
{
    
    $lablIDClub = $club->getIdClub();
    $lablNomClub = $club->getNomClub();
    $lablAdrClub = $club->getAdresseClub();
    $lablIDLigue = $club->getIdLigue();


   if($lablID==$lablIDLigue){

      //  $unformulaire->ajouterComposantLigne($unformulaire->creerCorp("corps","Nom du club affilié : ".$lablNomClub), "1");
       // $unformulaire->ajouterComposantLigne($unformulaire->creerCorp("corps","Adresse : ".$lablAdrClub), "1");
      // $data2 = array($lablNomClub,$lablAdrClub);
       array_push($data1,array($lablNomClub,$lablAdrClub));
   }


}

$tabClubsaffilié = new Tableau(1,$data1);
$tabClubsaffilié->setTitreTab("Clubs affilié : ");
$tabClubsaffilié->setTitreCol(array("Nom du club",'Adresse'));



$unformulaire->ajouterComposantTab();

$unformulaire->creerArticle();

require_once 'vue/vueLigues.php' ;
