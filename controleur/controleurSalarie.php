<?php

//On vérifie si c'est bien un salarié et si il est bien connecter
if($_SESSION['identification']->getStatut()=="salarié" && !empty($_SESSION['identification'])){
	
	//Création d'un formulaire pour afficher les informations de l'utilisateur
	$formulaireSalarie = new Formulaire('post', '?=salarié', 'fsalarié', 'fsalarié');
    
	$formulaireSalarie->ajouterComposantLigne($formulaireSalarie->creerLabel('Nom :'));
	$formulaireSalarie->ajouterComposantLigne($formulaireSalarie->creerInputTexteInvisible('nom', 'nom', $_SESSION['identification']->getNom(), 1, '', ''));
	$formulaireSalarie->ajouterComposantTab();

	$formulaireSalarie->ajouterComposantLigne($formulaireSalarie->creerLabel('Prenom :'));
	$formulaireSalarie->ajouterComposantLigne($formulaireSalarie->creerInputTexteInvisible('prenom', 'prenom', $_SESSION['identification']->getPrenom(), 1, '', ''));
	$formulaireSalarie->ajouterComposantTab();

    $formulaireSalarie->ajouterComposantLigne($formulaireSalarie->creerLabel('Login :'));
	$formulaireSalarie->ajouterComposantLigne($formulaireSalarie->creerInputTexteInvisible('login', 'login', $_SESSION['identification']->getLogin(), 1, '', ''));
    $formulaireSalarie->ajouterComposantTab();
	
	$formulaireSalarie->ajouterComposantLigne($formulaireSalarie->creerMessage($messageErreurConnexion));
	$formulaireSalarie->ajouterComposantTab();
	
    $formulaireSalarie->creerFormulaire();
    
    function afficherTableau(){
		$composant = "<table border='1'>
        <tr>
        <th>Date début</th>
        <th>Date fin</th>
        <th>Type de contrat</th>
        <th>Nombre d'heure</th>
        <th>Bulletin de salaire</th>
        </tr>";

        $liste = UtilisateurDAO::getContrat($_SESSION['identification']->getIdUser());
        foreach($liste as $row)
        {
			$composant .= "<tr>";
			$composant .= "<td>" . $row['dateDebut'] . "</td>";
			$composant .= "<td>" . $row['dateFin'] . "</td>";
			$composant .= "<td>" . $row['typeContrat'] . "</td>";
            $composant .= "<td>" . $row['nbHeures'] . "</td>";
            $bulletin = UtilisateurDAO::getBulletin(UtilisateurDAO::getIdContrat($_SESSION['identification']->getIdUser()));
            foreach($bulletin as $row)
            {
                $composant .= "<td> <a href ='";
                $composant .=  $row['buletinPDF'] . "' title='Afficher' target='blank_'> Afficher</a>";
                $composant .= "</td>";
            }
			$composant .= "</tr>";
        }
		$composant .= "</table>";

        echo $composant;
    }

    require_once 'vue/vueSalarie.php';

}
else{
	$_SESSION['identification']=[];
	$_SESSION['m2lMP']="accueil";
	header('location: index.php');
}
?>