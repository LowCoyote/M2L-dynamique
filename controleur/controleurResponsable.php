<?php
//On vérifie si c'est bien un responsable et si il est bien connecter
if($_SESSION['identification']->getIdFonct()=="3" && !empty($_SESSION['identification'])){

    //Fonction pour afficher et modifier les intervenants
    function afficherTableauIntervenant(){
		$composant = "<table class='table' border='1'>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Login</th>
                <th>Statut</th>
                <th>Type utilisateur</th>
                <th>Fonction</th>
                <th>id Ligue</th>
                <th>id Club</th>
                <th>Cliquez pour modifier</th>
                <th>Cliquez pour supprimer</th>
            </tr>
        </thead>";

        $liste = UtilisateurDAO::getIntervenants();
        foreach($liste as $row)
        {
            $composant .= "<form method='post' action='?m2lMP=ModifResponsable'>";
            $composant .= "<tbody>";
			$composant .= "<tr>";
			$composant .= "<td class='noDisplay'>" . "<input type='hidden' class='grey' name='idUser' id='idUser' value='" . $row['idUser'] ."'/>". "</td>";
			$composant .= "<td>" . "<input type='text' class='grey' name='nom' value='" . $row['nom'] ."'/>". "</td>";
			$composant .= "<td>" . "<input type='text' class='grey' name='prenom' value='" . $row['prenom'] ."'/>". "</td>";
            $composant .= "<td>" . "<input type='text' class='grey' name='login' value='" . $row['login'] ."'/>". "</td>";
            $composant .= "<td>" . "<input type='text' class='grey' name='statut' value='" . $row['statut'] ."'/>". "</td>";
            $composant .= "<td>" . "<input type='text' class='grey' name='typeUser' id='typeUser' value='" . $row['typeUser'] ."'/>". "</td>";
            $composant .= "<td>" . "<input type='text' class='grey' name='libelle' value='" . $row['libelle'] ."' disabled/>". "</td>";
            $composant .= "<td>" . "<input type='text' class='grey' name='idLigue' value='" . $row['idLigue'] ."' disabled/>". "</td>";
            $composant .= "<td>" . "<input type='text' class='grey' name='idClub' value='" . $row['idClub'] ."' disabled/>". "</td>";
            $composant .= "<td>"."<input type='submit' id='modif' value='Modifier'>". "</td>";
            $composant .= "</form>";
            $composant .= "<form method='post' action='?m2lMP=SuppResponsable'>";
            $composant .= "<td class='noDisplay'>" . "<input type='text' class='grey' name='idUser' id='idUser' value='" . $row['idUser'] ."'/>". "</td>";
            $composant .= "<td>"."<input type='submit' id='modif' value='Supprimer'>". "</td>";
            $composant .= "</form>";
			$composant .= "</tr>";
            $composant .= "</tbody>";
        }
		$composant .= "</table>";

        echo $composant;
    }

    //Fonction pour afficher et modifier les bulletins
    function afficherTableauBulletin(){

        $composant = "<table border='1' id='tablo' class='table'>
        <thead>
        <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Statut</th>
        <th>Type contrat</th>
        <th>Bulletin</th>
        <th>Cliquez pour modifier</th>
        </tr>
        </thead>";

        $liste = ResponsableDAO::getInfoSalarie();
        foreach($liste as $row)
        {
            $composant .= "<form method='post' action='?m2lMP=ModifResponsable'>";
            $composant .= "<tbody>";
            $composant .= "<tr>";
            $composant .= "<td class='noDisplay'>" . "<input type='hidden' class='grey' name='BidUser' id='idUser' value='" . $row['idUser'] ."'/>". "</td>";
            $composant .= "<td class='noDisplay'>" . "<input type='hidden' class='grey' name='BidContrat' id='idUser' value='" . $row['idContrat'] ."'/>". "</td>";
			$composant .= "<td>" . "<input type='text' class='grey' name='Bnom' value='" . $row['nom'] ."'/>". "</td>";
			$composant .= "<td>" . "<input type='text' class='grey' name='Bprenom' value='" . $row['prenom'] ."'/>". "</td>";
            $composant .= "<td>" . "<input type='text' class='grey' name='Bstatut' value='" . $row['statut'] ."'/>". "</td>";
            $composant .= "<td>" . "<input type='text' class='grey' name='BtypeContrat' value='" . $row['typeContrat'] ."'/>". "</td>";
            $composant .= "<td>" . "<input type='test' class='grey' name='BbulletinPDF' value='" . $row['BulletinPDF'] ."'/>". "</td>";
            $composant .= "<td>"."<input type='submit' id='modif' value='Modifier'>". "</td>";
            $composant .= "</form>";
			$composant .= "</tr>";
            $composant .= "</tbody>";
        }
		$composant .= "</table>";

        echo $composant;

    }


    require_once 'vue/vueResponsable.php';

}
else{
	$_SESSION['identification']=[];
	$_SESSION['m2lMP']="accueil";
	header('location: index.php');
}