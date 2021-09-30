<?php
/*****************************************************************************************************
 * Instancier un objet contenant la liste des Equipes et le conserver dans une variable de session
 *****************************************************************************************************/
$_SESSION['listFormations'] = new FormationsDTO(FormationDAO::lesFormations());

if(isset($_GET['MenuResponsablef'])){
    $_SESSION['MenuResponsablef']= $_GET['MenuResponsablef'];
}
else
{
    if(!isset($_SESSION['MenuResponsablef'])){
        $_SESSION['MenuResponsablef']="ajouter";
    }
}

// Créer un menu vertical

$menuFormation = new menu("menuFormation");
/*
foreach ($_SESSION['listFormations']->getFormations() as $uneFormation){
    $menuFormation->ajouterComposant($menuFormation->creerItemLien($uneFormation->getIdForma() ,$uneFormation->getIntitule()));
}*/


$menuFormation->ajouterComposant($menuFormation->creerItemLien("ajouter" ,"Nouvelle formations"));
$menuFormation->ajouterComposant($menuFormation->creerItemLien("formations" ,"Gerer les formations"));
//$menuFormation->ajouterComposant($menuFormation->creerItemLien("" ,""));


$leMenuResponsablef = $menuFormation->creerMenu2($_SESSION['MenuResponsablef'],'MenuResponsablef' , "Les Formations");



$option =$_SESSION['MenuResponsablef'];
if ($option == "ajouter")
{
    $unformulaire = new Formulaire("post", "index.php", "fNewForma", "fNewForma");
    $unformulaire->ajouterComposantLigne($unformulaire->creerTitre("titre",  "Ajouter une formations"),"1");

    $unformulaire->ajouterComposantLigne($unformulaire->creerLabel('intitule :'));
    $unformulaire->ajouterComposantLigne($unformulaire->creerInputTexte('intitule', 'intitule', '', 1, 'Entrez un intitule', ''));
    $unformulaire->ajouterComposantLigne($unformulaire->creerBr());

    $unformulaire->ajouterComposantLigne($unformulaire->creerLabel('descriptif :'));
    $unformulaire->ajouterComposantLigne($unformulaire->creerInputTexte('descriptif', 'descriptif', '', 1, 'Entrez une description', ''));
    $unformulaire->ajouterComposantLigne($unformulaire->creerBr());

    $unformulaire->ajouterComposantLigne($unformulaire->creerLabel('duree :'));
    $unformulaire->ajouterComposantLigne($unformulaire->creerInputTexte('duree', 'duree', '', 1, 'Entrez une duree en heur', ''));
    $unformulaire->ajouterComposantLigne($unformulaire->creerBr());

    $unformulaire->ajouterComposantLigne($unformulaire->creerLabel('dateOuvertureInscription :'));
    $unformulaire->ajouterComposantLigne($unformulaire->creerInputType('datetime-local', 'dateOuvertureInscription', 'dateOuvertureInscription', ""));
    $unformulaire->ajouterComposantLigne($unformulaire->creerBr());

    $unformulaire->ajouterComposantLigne($unformulaire->creerLabel('dateClotureInscription :'));
    $unformulaire->ajouterComposantLigne($unformulaire->creerInputType('datetime-local', 'dateClotureInscription', 'dateClotureInscription', ""));
    $unformulaire->ajouterComposantLigne($unformulaire->creerBr());

    $unformulaire->ajouterComposantLigne($unformulaire->creerLabel('effectifMax :'));
    $unformulaire->ajouterComposantLigne($unformulaire->creerInputTexte('effectifMax', 'effectifMax', '', 1, 'Entrez un effectif Max', ''));
    $unformulaire->ajouterComposantLigne($unformulaire->creerBr());


    $unformulaire->ajouterComposantLigne($unformulaire-> creerInputSubmit('submitNewForma', 'submitNewForma', " Creer la formation "));



    $unformulaire->ajouterComposantTab();
    $unformulaire->creerArticle();
}
else if ($option == "formations")
{
    $unformulaire = new Formulaire("post", "index.php", "fConnexion", "fConnexion");
    $unformulaire->ajouterComposantLigne($unformulaire->creerTitre("titre",  "Gerer les formations "),"1");

    $unformulaire->ajouterComposantLigne($unformulaire->creerLabel('intitule :'));
    $unformulaire->ajouterComposantLigne($unformulaire->creerInputTexte('intitule', 'intitule', '', 1, 'Entrez un intitule', ''));

    $unformulaire->ajouterComposantTab();
    $unformulaire->creerArticle();
}



/*
$unformulaire->ajouterComposantLigne($unformulaire->creerLabel('Identifiant :'));
$unformulaire->ajouterComposantLigne($unformulaire->creerInputTexte('login', 'login', '', 1, 'Entrez votre identifiant', ''));
$unformulaire->ajouterComposantTab();

$unformulaire->ajouterComposantLigne($unformulaire->creerLabel('Mot de Passe :'));
$unformulaire->ajouterComposantLigne($unformulaire->creerInputMdp('mdp', 'mdp',  1, 'Entrez votre mot de passe', ''));
$unformulaire->ajouterComposantTab();

$unformulaire->ajouterComposantLigne($unformulaire-> creerInputSubmit('submitConnex', 'submitConnex', 'Valider'));
$unformulaire->ajouterComposantTab();

$unformulaire->ajouterComposantLigne($unformulaire->creerMessage($messageErreurConnexion));
$unformulaire->ajouterComposantTab();*/

/*
$unformulaire->ajouterComposantLigne($unformulaire->creerTitre("titre",  "Creer formation"),"1");

$unformulaire->ajouterComposantLigne($unformulaire->creerCorp("corps","gg"), "1");
$unformulaire->ajouterComposantLigne($unformulaire->creerInputTexte('login', 'login', '', 1, 'Entrez votre identifiant', ''));


$unformulaire->ajouterComposantLigne($unformulaire->creerCorp("corps","gg"), "1");
$unformulaire->ajouterComposantLigne($unformulaire->creerInputMdp('mdp', 'mdp',  1, 'Entrez votre mot de passe', ''));




$unformulaire->ajouterComposantLigne($unformulaire->creerCorp("corps","gg"), "1");


$unformulaire->ajouterComposantLigne($unformulaire->creerCorp("corps","gg"), "1");

$unformulaire->ajouterComposantLigne($unformulaire-> creerInputSubmit2('submitConnex', 'submitAdd', "Creer cétte formation"));
$unformulaire->ajouterComposantTab();*/


//$unformulaire->creerArticle();



require_once 'vue/vueResponsablef.php';
