<?php
//On vérifie qu'il est bien connecté
<<<<<<< Updated upstream
if($_SESSION['identification']->getIdFonct()=="2" && !empty($_SESSION['identification'])){
    //On vérifie que le champs idUser est pas vide
    if(isset($_POST['idUser']) && !empty($_POST['idUser'])){
        UtilisateurDAO::modifIntervenant($_POST['idUser'], $_POST['nom'], $_POST['prenom'], $_POST['login'], $_POST['statut'], $_POST['typeUser']);
=======
if($_SESSION['identification']->getIdFonct()=="3" && !empty($_SESSION['identification'])){
    //On vérifie que le champs idUser est pas vide
    //et on modifie pour les infos intervenant
    if(isset($_POST['idUser']) && !empty($_POST['idUser'])){
        ResponsableDAO::modifIntervenant($_POST['idUser'], $_POST['nom'], $_POST['prenom'], $_POST['login'], $_POST['statut'], $_POST['typeUser']);
        $_SESSION['m2lMP']="responsable";
        header('location: index.php');
    }
    //Ici on modifie les contrats et les bulletins 
    elseif(isset($_POST['Bnom']) && !empty($_POST['Bnom']) && isset($_POST['Bprenom']) && !empty($_POST['Bprenom']) && isset($_POST['Bstatut']) && !empty($_POST['Bstatut']) && isset($_POST['BbulletinPDF']) && !empty($_POST['BbulletinPDF']) && isset($_POST['BtypeContrat']) && !empty($_POST['BtypeContrat'])){
        ResponsableDAO::modifContrat($_POST['BidUser'], $_POST['Bnom'], $_POST['Bprenom'], $_POST['Bstatut'], $_POST['BtypeContrat'], $_POST['BbulletinPDF'], $_POST['BidContrat']);
>>>>>>> Stashed changes
        $_SESSION['m2lMP']="responsable";
        header('location: index.php');
    }
    else{
        $_SESSION['m2lMP']="responsable";
        header('location: index.php');
        echo "Une erreur est survenue";
    }
}
else
{
	$_SESSION['identification']=[];
	$_SESSION['m2lMP']="accueil";
	header('location: index.php');
}