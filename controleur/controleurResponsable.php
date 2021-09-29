<?php
//On vérifie si c'est bien un responsable et si il est bien connecter
if($_SESSION['identification']->getIdFonct()=="2" && !empty($_SESSION['identification'])){

    function afficherTableauIntervenant(){
		$composant = "<table border='1'>
        <tr>
        <th>id Utilisateur</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Login</th>
        <th>Statut</th>
        <th>Type utilisateur</th>
        <th>Fonction</th>
        <th>id Ligue</th>
        <th>id Club</th>
        </tr>";

        $liste = UtilisateurDAO::getIntervenants();
        foreach($liste as $row)
        {
            //idUser, nom, prenom, login, statut, typeUser, fonction.libelle, idLigue, idClub
			$composant .= "<tr>";
			$composant .= "<td>" . $row['idUser'] . "</td>";
			$composant .= "<td>" . $row['nom'] . "</td>";
			$composant .= "<td>" . $row['prenom'] . "</td>";
            $composant .= "<td>" . $row['login'] . "</td>";
            $composant .= "<td>" . $row['statut'] . "</td>";
            $composant .= "<td>" . $row['typeUser'] . "</td>";
            $composant .= "<td>" . $row['libelle'] . "</td>";
            $composant .= "<td>" . $row['idLigue'] . "</td>";
            $composant .= "<td>" . $row['idClub'] . "</td>";
			$composant .= "</tr>";
        }
		$composant .= "</table>";

        echo $composant;
    }

    function test(){
        $composant = "<form name='search' method='post' action='?index.php'>";
        $composant .= "<p>";
        $composant .= "<select  name = 'liste' id = 'idUserListe' >";
        $options = UtilisateurDAO::getAllnom();
            foreach ($options as $option){
                $composant .= "<option value = " ;
                $composant .= $option["nom"].">";
                $composant .= $option["nom"];
                $composant .= "</option>";
            }
        $composant .= "</select></td></tr>";
        $composant .= "</p>";
        $composant .= "</form>";
        $composant .= "<input type='submit' name='liste' value='Modifier'/>"; 
        echo $composant;
    }

    if(isset($_POST['liste'])){
        echo "ped";
    }

    require_once 'vue/vueResponsable.php';

}
else{
	$_SESSION['identification']=[];
	$_SESSION['m2lMP']="accueil";
	header('location: index.php');
}