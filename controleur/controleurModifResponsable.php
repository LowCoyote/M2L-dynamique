<?php
//On vérifie qu'il est bien connecté
if($_SESSION['identification']->getIdFonct()=="2" && !empty($_SESSION['identification'])){
    //On vérifie que le champs idUser est pas vide
    if(isset($_POST['idUser']) && !empty($_POST['idUser'])){
        UtilisateurDAO::modifIntervenant($_POST['idUser'], $_POST['nom'], $_POST['prenom'], $_POST['login'], $_POST['statut'], $_POST['typeUser']);
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