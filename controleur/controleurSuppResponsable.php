<?php
if($_SESSION['identification']->getIdFonct()=="3" && !empty($_SESSION['identification'])){
    if(isset($_POST['idUser'])){
        ResponsableDAO::SuppIntervenants($_POST['idUser']);
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

