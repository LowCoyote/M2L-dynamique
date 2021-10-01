<?php
if($_SESSION['identification']->getIdFonct()=="2" && !empty($_SESSION['identification'])){
    if(isset($_POST['idUser'])){
        UtilisateurDAO::SuppIntervenants($_POST['idUser']);
        $_SESSION['m2lMP']="responsable";
        header('location: index.php');
    }
}
else
{
	$_SESSION['identification']=[];
	$_SESSION['m2lMP']="accueil";
	header('location: index.php');
}

