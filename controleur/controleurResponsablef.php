<?php

//
$_SESSION['listFormations'] = new FormationsDTO(FormationDAO::lesFormations());
$_SESSION['listFormationsDEffectues'] = new FormationsDTO(FormationDAO::lesFormationsDEffectues());
$_SESSION['listeDemandesEffectues'] = new EffectuesDTO(EffectueDAO::lesDemandesEffectues());
$_SESSION['listeUtilisateurs'] = new UtilisateursDTO(UtilisateurDAO::lesUtilisateurs());


if (isset($_GET['MenuResponsablef'])) {
    $_SESSION['MenuResponsablef'] = $_GET['MenuResponsablef'];
    if (isset($_GET['id'])) {
        $_SESSION['formaID'] = $_GET['id'];

    }
} else {
    if (!isset($_SESSION['MenuResponsablef'])) {
        $_SESSION['MenuResponsablef'] = "ajouter";
    }
}

// Créer un menu vertical

$menuFormation = new menu("menuFormation");

$menuFormation->ajouterComposant($menuFormation->creerItemLien("ajouter", "Nouvelle formations"));
$menuFormation->ajouterComposant($menuFormation->creerItemLien("formations", "Gerer les formations"));
$menuFormation->ajouterComposant($menuFormation->creerItemLien("demandes", "Gerer les demandes"));

$leMenuResponsablef = $menuFormation->creerMenu2($_SESSION['MenuResponsablef'], 'MenuResponsablef', "Les Formations");


$option = $_SESSION['MenuResponsablef'];
if ($option == "ajouter") {
    $unformulaire = new Formulaire("post", "index.php", "fNewForma", "fNewForma");
    $unformulaire->ajouterComposantLigne($unformulaire->creerTitre("titre", "Ajouter une formations"), "1");

    $unformulaire->ajouterComposantLigne($unformulaire->creerLabel('intitule :'));
    $unformulaire->ajouterComposantLigne($unformulaire->creerInputTexte('intitule', 'intitule', '', 1, 'Entrez un intitule', ''));
    $unformulaire->ajouterComposantLigne($unformulaire->creerBr());

    $unformulaire->ajouterComposantLigne($unformulaire->creerLabel('descriptif :'));
    $unformulaire->ajouterComposantLigne($unformulaire->creerInputTexte('descriptif', 'descriptif', '', 1, 'Entrez une description', ''));
    $unformulaire->ajouterComposantLigne($unformulaire->creerBr());

    $unformulaire->ajouterComposantLigne($unformulaire->creerLabel('duree :'));
    $unformulaire->ajouterComposantLigne($unformulaire->creerInputType('number', 'duree', 'duree', '', 'Entrez une duree en heur'));
    $unformulaire->ajouterComposantLigne($unformulaire->creerBr());

    $unformulaire->ajouterComposantLigne($unformulaire->creerLabel('dateOuvertureInscription :'));
    $unformulaire->ajouterComposantLigne($unformulaire->creerInputType('date', 'dateOuvertureInscription', 'dateOuvertureInscription', ""));
    $unformulaire->ajouterComposantLigne($unformulaire->creerBr());

    $unformulaire->ajouterComposantLigne($unformulaire->creerLabel('dateClotureInscription :'));
    $unformulaire->ajouterComposantLigne($unformulaire->creerInputType('date', 'dateClotureInscription', 'dateClotureInscription', ""));
    $unformulaire->ajouterComposantLigne($unformulaire->creerBr());

    $unformulaire->ajouterComposantLigne($unformulaire->creerLabel('effectifMax :'));
    $unformulaire->ajouterComposantLigne($unformulaire->creerInputTexte('effectifMax', 'effectifMax', '', 1, 'Entrez un effectif Max', ''));
    $unformulaire->ajouterComposantLigne($unformulaire->creerBr());


    $unformulaire->ajouterComposantLigne($unformulaire->creerInputSubmit('submitNewForma', 'submitNewForma', " Creer la formation "));


    $unformulaire->ajouterComposantTab();
    $unformulaire->creerArticle();
}
else if ($option == "formations") {
    $gestForma = new Formulaire("post", "index.php", "fConnexion", "fConnexion");
    $gestForma->ajouterComposantLigne($gestForma->creerTitre("titre", "Gerer les formations "), "1");
    $gestForma->ajouterComposantTab();
    $gestForma->creerArticle();

    function afficherTableauCRUD()
    {
        $composant = "<div class='article'><div class='corps'>
            <table class='tab'>
                        <thead>
                            <tr>
                                <td>intitule</td>
                                <td>descriptif</td>
                                <td>duree</td>
                                <td>dateOuvertureInscription</td>
                                <td>dateClotureInscription</td>
                                <td>effectifMax</td>
                            <td>Details</td>
                            <td>Modifier</td>
                            <td>Supprimer</td></tr>
                        </thead>";

        foreach ($_SESSION['listFormations']->getFormations() as $uneFormation) {
            $composant .= '<tr class="pair" >';

            $composant .= "<td>" . $uneFormation->getIntitule() . "</td>";
            $composant .= "<td>" . $uneFormation->getDescriptif() . "</td>";
            $composant .= "<td>" . $uneFormation->getDuree() . "</td>";
            $composant .= "<td>" . $uneFormation->getDateOuvertureInscription() . "</td>";
            $composant .= "<td>" . $uneFormation->getDateClotureInscription() . "</td>";
            $composant .= "<td>" . $uneFormation->getEffectifMax() . "</td>";

            $id = $uneFormation->getIdForma();


            // $formModifier = '<a href="?MenuResponsablef=modifier&id='.$id.'">Modifier</a>';
            $formModifier = '<a href="?MenuResponsablef=formation&id=' . $id . '"><input type="button" value="Voir la formation"/></a>';
            $composant .= "<td>" . $formModifier . "</td>";

            // $formModifier = '<a href="?MenuResponsablef=modifier&id='.$id.'">Modifier</a>';
            $formModifier = '<a href="?MenuResponsablef=modifier&id=' . $id . '"><input type="button" value="Modifier"/></a>';
            $composant .= "<td>" . $formModifier . "</td>";

            $formSupprimer = '<a href="?MenuResponsablef=supprimer&id=' . $id . '"><input type="button" value="Supprimer"/></a>';
            //  $formSupprimer = '<a href="?MenuResponsablef=supprimer&id='.$id.'">Supprimer</a>';
            $composant .= "<td>" . $formSupprimer . "</td>";

            $composant .= "</tr>";
        }

        $composant .= "</table></div></div>";

        echo $composant;
    }

    $gestDemande = new Formulaire("post", "index.php", "fConnexion", "fConnexion");
    $gestDemande->ajouterComposantLigne($gestDemande->creerTitre("titre", "Gerer les demandes "), "1");
    $gestDemande->ajouterComposantTab();
    $gestDemande->creerArticle();


}
else if ($option == "demandes") {

    function creerFormulaireDemande($uneFormation, $listeDemandesEffectues, $listeUtilisateurs)
    {

        $idForma = $uneFormation->getIdForma();
        $lablIntitule = $uneFormation->getIntitule();
        $lablDescriptif = $uneFormation->getDescriptif();
        $labdateOuvertureInscription = $uneFormation->getIdForma();
        $labdateClotureInscription = $uneFormation->getIdForma();
        $lableffectifMax = $uneFormation->getIdForma();
        $idForma = $uneFormation->getIdForma();

        $formForma = new Formulaire("post", "index.php", "demandeEffectues", "form");

        $formForma->ajouterComposantLigne($formForma->creerID("idForma", $idForma, ""), "1");
        $formForma->ajouterComposantLigne($formForma->creerTitre("titre", "Intitule :" . $lablIntitule . ""), "1");
        $formForma->ajouterComposantLigne($formForma->creerCorp("corps", $lablDescriptif), "1");

        $count = EffectueDAO::nbValideeDemandeForma($uneFormation->getIdForma());

        $formForma->ajouterComposantLigne($formForma->creerCorp("corps", "Les Demandes pour effectuer cette formation : (" . $count . ' sur ' . $uneFormation->getEffectifMax() . ') personne sont deja accepte)'), "1");

        $composant = "<table class='tab'>
                        <thead>
                            <tr>
                                <td>Nom</td>
                                <td>Prenom</td>
                                <td>EtatInscription</td>
                                <td>DateInscription</td>		
                                <td>Accepter</td>
                                <td>Reufser</td>
                            </tr>
                        </thead>";

        foreach ($listeDemandesEffectues->getEffectues() as $uneDemandesEffectue) {
            if ($uneDemandesEffectue->getIdForma() == $idForma) {
                $user = $listeUtilisateurs->chercheUtilisateur($uneDemandesEffectue->getIdUser());

                $composant .= '<tr class="pair" >';

                $composant .= "<td>" . $user->getNom() . "</td>";
                $composant .= "<td>" . $user->getPrenom() . "</td>";

                $composant .= "<td>" . $uneDemandesEffectue->getEtatInscription() . "</td>";
                $composant .= "<td>" . $uneDemandesEffectue->getDateInscription() . "</td>";


                if ($uneFormation->getEffectifMax() <= $count) {
                    $enabled = "disabled";
                } else {
                    $enabled = "";
                }

                $composant .= '<td><form method="post" action="index.php" name="fAccepterDemandeForma" class="fAccepterDemandeForma"><input id="idForma" name="idForma" type="hidden" value="' . $uneDemandesEffectue->getIdForma() . '">
                    <input id="idUser" name="idUser" type="hidden" value="' . $uneDemandesEffectue->getIdUser() . '">
                    <input ' . $enabled . ' type="submit" name="submitAccepterDemande" id="submitAccepterDemande" value=" Accepter"></form></td>';

                if ($uneDemandesEffectue->getEtatInscription() == "REFUSÉE") {
                    $enabled = "disabled";
                } else {
                    $enabled = "";
                }

                $composant .= '<td><form method="post" action="index.php" name="fAccepterDemandeForma" class="fAccepterDemandeForma"><input id="idForma" name="idForma" type="hidden" value="' . $uneDemandesEffectue->getIdForma() . '">
                    <input id="idUser" name="idUser" type="hidden" value="' . $uneDemandesEffectue->getIdUser() . '">
                    <input ' . $enabled . ' type="submit" name="submitRefuserDemande" id="submitRefuserDemande" value=" Reufser "></form></td>';

                $composant .= "</tr>";
            }
        }

        $composant .= "</table>";
        $formForma->ajouterComposantLigne($formForma->creerCorpDiv("corps", $composant), "1");
        $formForma->ajouterComposantTab();
        $formForma->creerArticle2();
        return $formForma;
    }

    foreach ($_SESSION['listFormationsDEffectues']->getFormations() as $uneFormation) {
        //Liste des Demandes Effectues
        $listeDemandesEffectues = $_SESSION['listeDemandesEffectues'];
        //Liste des Utilisateurs
        $listeUtilisateurs = $_SESSION['listeUtilisateurs'];
        //Creation du tableau des demandes en passant les liste des demandes effectues et des utilisateurs
        $lesFormForma[$uneFormation->getIdForma()] = creerFormulaireDemande($uneFormation, $listeDemandesEffectues, $listeUtilisateurs);
    }

    if (empty($lesFormForma)) {
        $message = 'Aucune demande pour aucune formation disponible !!';
    }

}
else if ($option == "modifier") {
    $optID = $_SESSION['formaID'];
    $formaToEdit = $_SESSION['listFormations']->chercheFormation($optID);

    $idForma = $formaToEdit->getIdForma();
    $intitule = $formaToEdit->getIntitule();
    $descriptif = $formaToEdit->getDescriptif();
    $duree = $formaToEdit->getDuree();
    $dateOuvertureInscription = $formaToEdit->getDateOuvertureInscription();
    $dateClotureInscription = $formaToEdit->getDateClotureInscription();
    $effectifMax = $formaToEdit->getEffectifMax();


    $editForm = new Formulaire("post", "index.php", "fEditForma", "fEditForma");
    $editForm->ajouterComposantLigne($editForm->creerTitre("titre", "Modifier la formation : " . $intitule), "1");

    $editForm->ajouterComposantLigne($editForm->creerID("idForma", $idForma, ""), "WW");

    $editForm->ajouterComposantLigne($editForm->creerLabel('intitule :'));
    $editForm->ajouterComposantLigne($editForm->creerInputTexte('intitule', 'intitule', $intitule, 1, 'Entrez un intitule', ''));
    $editForm->ajouterComposantLigne($editForm->creerBr());

    $editForm->ajouterComposantLigne($editForm->creerLabel('descriptif :'));
    $editForm->ajouterComposantLigne($editForm->creerInputTexte('descriptif', 'descriptif', $descriptif, 1, 'Entrez une description', ''));
    $editForm->ajouterComposantLigne($editForm->creerBr());

    $editForm->ajouterComposantLigne($editForm->creerLabel('duree :'));
    $editForm->ajouterComposantLigne($editForm->creerInputType('number', 'duree', 'duree', $duree, 'Entrez une duree en heur'));
    $editForm->ajouterComposantLigne($editForm->creerBr());

    $editForm->ajouterComposantLigne($editForm->creerLabel('dateOuvertureInscription :'));
    $editForm->ajouterComposantLigne($editForm->creerInputType('date', 'dateOuvertureInscription', 'dateOuvertureInscription', $dateOuvertureInscription));
    $editForm->ajouterComposantLigne($editForm->creerBr());

    $editForm->ajouterComposantLigne($editForm->creerLabel('dateClotureInscription :'));
    $editForm->ajouterComposantLigne($editForm->creerInputType('date', 'dateClotureInscription', 'dateClotureInscription', $dateClotureInscription));
    $editForm->ajouterComposantLigne($editForm->creerBr());

    $editForm->ajouterComposantLigne($editForm->creerLabel('effectifMax :'));
    $editForm->ajouterComposantLigne($editForm->creerInputTexte('effectifMax', 'effectifMax', $effectifMax, 1, 'Entrez un effectif Max', ''));
    $editForm->ajouterComposantLigne($editForm->creerBr());


    $editForm->ajouterComposantLigne($editForm->creerInputSubmit('submitEditForma', 'submitEditForma', " Modifier la formation "));


    $editForm->ajouterComposantTab();
    $editForm->creerArticle();


}
else if ($option == "formation") {

    $optID = $_SESSION['formaID'];
    $formaToEdit = $_SESSION['listFormations']->chercheFormation($optID);

    $idForma = $formaToEdit->getIdForma();
    $intitule = $formaToEdit->getIntitule();
    $descriptif = $formaToEdit->getDescriptif();
    $duree = $formaToEdit->getDuree();
    $dateOuvertureInscription = $formaToEdit->getDateOuvertureInscription();
    $dateClotureInscription = $formaToEdit->getDateClotureInscription();
    $effectifMax = $formaToEdit->getEffectifMax();

    $viewForm = new Formulaire("post", "index.php", "fInscFormation", "form");

    $viewForm->ajouterComposantLigne($viewForm->creerID("idForma", $idForma, ""), "WW");

    $viewForm->ajouterComposantLigne($viewForm->creerTitre("titre", "Intitule :" . $intitule . ""), "1");


    $viewForm->ajouterComposantLigne($viewForm->creerCorp("corps", $descriptif), "1");


    $extra1 = "Formation de " . $duree . " heures | Effectif max est de : " . $effectifMax . "";
    $extra2 = "Commence le : " . $dateOuvertureInscription . " et se finit le : " . $dateClotureInscription . "";

    $viewForm->ajouterComposantLigne($viewForm->creerCorp("corps", $extra1 . "<br>" . $extra2), "1");


    $viewForm->ajouterComposantTab();


    $viewForm->creerArticle2();

}
else if ($option == "supprimer") {
    $optID = null;
    $optID = $_SESSION['formaID'];
    FormationDAO::supprimerFormation($optID);
    $message = "La formation a bien ete supprimer";
}


require_once 'vue/vueResponsablef.php';
