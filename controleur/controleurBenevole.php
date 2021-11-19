<?php
//On vérifie si c'est bien un bénévole et si il est bien connecter
if($_SESSION['identification']->getStatut()=="bénévole" && !empty($_SESSION['identification'])){
	
	//Création d'un formulaire pour afficher les informations de l'utilisateur
	$formulaireBenevole = new Formulaire('post', '?=benevole', 'fBenevole', 'fBenevole');
	
	$formulaireBenevole->ajouterComposantLigne($formulaireBenevole->creerLabel('Nom :'));
	$formulaireBenevole->ajouterComposantLigne($formulaireBenevole->creerInputTexteInvisible('nom', 'nom', $_SESSION['identification']->getNom(), 1, '', ''));
	$formulaireBenevole->ajouterComposantTab();

	$formulaireBenevole->ajouterComposantLigne($formulaireBenevole->creerLabel('Prenom :'));
	$formulaireBenevole->ajouterComposantLigne($formulaireBenevole->creerInputTexteInvisible('prenom', 'prenom', $_SESSION['identification']->getPrenom(), 1, '', ''));
	$formulaireBenevole->ajouterComposantTab();

    $formulaireBenevole->ajouterComposantLigne($formulaireBenevole->creerLabel('Login :'));
	$formulaireBenevole->ajouterComposantLigne($formulaireBenevole->creerInputTexteInvisible('login', 'login', $_SESSION['identification']->getLogin(), 1, '', ''));
    $formulaireBenevole->ajouterComposantTab();
	
	$formulaireBenevole->ajouterComposantLigne($formulaireBenevole->creerMessage($messageErreurConnexion));
	$formulaireBenevole->ajouterComposantTab();
	
	$formulaireBenevole->creerFormulaire();

	require_once 'vue/vueBenevole.php' ;

}
else{
	$_SESSION['identification']=[];
	$_SESSION['m2lMP']="accueil";
	header('location: index.php');
}

?>

