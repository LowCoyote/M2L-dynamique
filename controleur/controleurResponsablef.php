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
$menuFormation->ajouterComposant($menuFormation->creerItemLien("gererFormations", "Gerer les formations"));
$menuFormation->ajouterComposant($menuFormation->creerItemLien("gererDemandes", "Gerer les demandes"));

$leMenuResponsablef = $menuFormation->creerMenu2($_SESSION['MenuResponsablef'], 'MenuResponsablef', "Les Formations");


$option = $_SESSION['MenuResponsablef'];
if ($option == "ajouter") {
    $addForm = new Formulaire("post", "index.php", "fNewForma", "fNewForma");

    $addForm->ajouterComposantLigne($addForm->creerTitre("titre", "Ajouter une formations"), "1");

    $addForm->ajouterComposantLigne($addForm->corpsDebut());

    $addForm->ajouterComposantLigne($addForm->creerLabelFor('intitule','Nom de la formation :'));
    $addForm->ajouterComposantLigne($addForm->creerBr());
    $addForm->ajouterComposantLigne($addForm->creerInputTexte('intitule', 'intitule', '', 1, 'Entrez un intitule', ''));
    $addForm->ajouterComposantLigne($addForm->creerBr());

    $addForm->ajouterComposantLigne($addForm->creerLabelFor('descriptif','Description formation :'));
    $addForm->ajouterComposantLigne($addForm->creerBr());
    $addForm->ajouterComposantLigne($addForm->creerTextarea('descriptif', 'descriptif', 'Entrez une description', 6, 80, ''));
    $addForm->ajouterComposantLigne($addForm->creerBr());

    $addForm->ajouterComposantLigne($addForm->creerLabelFor('duree','La duree : (en heure)'));
    $addForm->ajouterComposantLigne($addForm->creerBr());
    $addForm->ajouterComposantLigne($addForm->creerInputType('number', 'duree', 'duree', '', 'Entrez une duree en heure'));
    $addForm->ajouterComposantLigne($addForm->creerBr());

    $addForm->ajouterComposantLigne($addForm->creerLabelFor('dateOuvertureInscription','Date d&rsquo;Ouverture de l&rsquo;Inscription:'));
    $addForm->ajouterComposantLigne($addForm->creerBr());
    $addForm->ajouterComposantLigne($addForm->creerInputType('date', 'dateOuvertureInscription', 'dateOuvertureInscription', ""));
    $addForm->ajouterComposantLigne($addForm->creerBr());

    $addForm->ajouterComposantLigne($addForm->creerLabelFor('dateClotureInscription','Date de Cloture de l&rsquo;Inscription :'));
    $addForm->ajouterComposantLigne($addForm->creerBr());
    $addForm->ajouterComposantLigne($addForm->creerInputType('date', 'dateClotureInscription', 'dateClotureInscription', ""));
    $addForm->ajouterComposantLigne($addForm->creerBr());

    $addForm->ajouterComposantLigne($addForm->creerLabelFor('dateDebut','Date de Debut de l&rsquo;Inscription  :'));
    $addForm->ajouterComposantLigne($addForm->creerBr());
    $addForm->ajouterComposantLigne($addForm->creerInputType('date', 'dateDebut', 'dateDebut', ""));
    $addForm->ajouterComposantLigne($addForm->creerBr());

    $addForm->ajouterComposantLigne($addForm->creerLabelFor('dateFin','Date de Fin de l&rsquo;Inscription :'));
    $addForm->ajouterComposantLigne($addForm->creerBr());
    $addForm->ajouterComposantLigne($addForm->creerInputType('date', 'dateFin', 'dateFin', ""));
    $addForm->ajouterComposantLigne($addForm->creerBr());

    $addForm->ajouterComposantLigne($addForm->creerLabelFor('effectifMax','L&rsquo;effectif Maximum :'));
    $addForm->ajouterComposantLigne($addForm->creerBr());
    $addForm->ajouterComposantLigne($addForm->creerInputTexte('effectifMax', 'effectifMax', '', 1, 'Entrez un effectif Max', ''));
    $addForm->ajouterComposantLigne($addForm->creerBr());

    $addForm->ajouterComposantLigne($addForm->divFin());

    $addForm->ajouterComposantLigne($addForm->creerInputSubmit2('submitNewForma', 'submitNewForma', " Creer la formation "));
    $addForm->ajouterComposantTab();

    $addForm->creerArticle();
} // creation du formulaire pour ajouter une nouvelle formation
else if ($option == "modifier") {
    $optID = $_SESSION['formaID'];
    $formaToEdit = $_SESSION['listFormations']->chercheFormation($optID);

    $idForma = $formaToEdit->getIdForma();
    $intitule = $formaToEdit->getIntitule();
    $descriptif = $formaToEdit->getDescriptif();
    $duree = $formaToEdit->getDuree();
    $dateOuvertureInscription = $formaToEdit->getDateOuvertureInscription();
    $dateClotureInscription = $formaToEdit->getDateClotureInscription();
    $dateDebut = $formaToEdit->getDateDebut();
    $dateFin = $formaToEdit->getDateFin();
    $effectifMax = $formaToEdit->getEffectifMax();


    $editForm = new Formulaire("post", "index.php", "fEditForma", "fEditForma");
    $editForm->ajouterComposantLigne($editForm->creerTitre("titre", "Modifier la formation : " . $intitule), "1");

    $editForm->ajouterComposantLigne($editForm->corpsDebut());

    $editForm->ajouterComposantLigne($editForm->creerID("idForma", $idForma, ""), "WW");

    $editForm->ajouterComposantLigne($editForm->creerLabelFor('intitule','Nom de la formation :'));
    $editForm->ajouterComposantLigne($editForm->creerBr());
    $editForm->ajouterComposantLigne($editForm->creerInputTexte('intitule', 'intitule', $intitule, 1, 'Entrez un intitule', ''));
    $editForm->ajouterComposantLigne($editForm->creerBr());

    $editForm->ajouterComposantLigne($editForm->creerLabelFor('descriptif','Description formation :'));
    $editForm->ajouterComposantLigne($editForm->creerBr());
    $editForm->ajouterComposantLigne($editForm->creerTextarea('descriptif', 'descriptif', 'Entrez une description', 6, 80, $descriptif));

    $editForm->ajouterComposantLigne($editForm->creerBr());

    $editForm->ajouterComposantLigne($editForm->creerLabelFor('duree','La duree : (en heure)'));
    $editForm->ajouterComposantLigne($editForm->creerBr());
    $editForm->ajouterComposantLigne($editForm->creerInputType('number', 'duree', 'duree', $duree, 'Entrez une duree en heure'));
    $editForm->ajouterComposantLigne($editForm->creerBr());

    $editForm->ajouterComposantLigne($editForm->creerLabelFor('dateOuvertureInscription','Date d&rsquo;Ouverture de l&rsquo;Inscription:'));
    $editForm->ajouterComposantLigne($editForm->creerBr());
    $editForm->ajouterComposantLigne($editForm->creerInputType('date', 'dateOuvertureInscription', 'dateOuvertureInscription', $dateOuvertureInscription));
    $editForm->ajouterComposantLigne($editForm->creerBr());

    $editForm->ajouterComposantLigne($editForm->creerLabelFor('dateClotureInscription','Date de Cloture de l&rsquo;Inscription :'));
    $editForm->ajouterComposantLigne($editForm->creerBr());
    $editForm->ajouterComposantLigne($editForm->creerInputType('date', 'dateClotureInscription', 'dateClotureInscription', $dateClotureInscription));
    $editForm->ajouterComposantLigne($editForm->creerBr());


    $editForm->ajouterComposantLigne($editForm->creerLabelFor('dateDebut','Date de Debut de l&rsquo;Inscription  :'));
    $editForm->ajouterComposantLigne($editForm->creerBr());
    $editForm->ajouterComposantLigne($editForm->creerInputType('date', 'dateDebut', 'dateDebut', $dateDebut));
    $editForm->ajouterComposantLigne($editForm->creerBr());

    $editForm->ajouterComposantLigne($editForm->creerLabelFor('dateFin','Date de Fin de l&rsquo;Inscription :'));
    $editForm->ajouterComposantLigne($editForm->creerBr());
    $editForm->ajouterComposantLigne($editForm->creerInputType('date', 'dateFin', 'dateFin', $dateFin));
    $editForm->ajouterComposantLigne($editForm->creerBr());


    $editForm->ajouterComposantLigne($editForm->creerLabelFor('effectifMax','L&rsquo;effectif Maximum :'));
    $editForm->ajouterComposantLigne($editForm->creerBr());
    $editForm->ajouterComposantLigne($editForm->creerInputTexte('effectifMax', 'effectifMax', $effectifMax, 1, 'Entrez un effectif Max', ''));
    $editForm->ajouterComposantLigne($editForm->creerBr());

    $editForm->ajouterComposantLigne($editForm->creerInputSubmit('submitEditForma', 'submitEditForma', " Modifier la formation "));


    $editForm->ajouterComposantTab();
    $editForm->creerArticle();


} // creation du formulaire pour modifier une formation
else if ($option == "afficher") {

    $optID = $_SESSION['formaID'];
    $formaToEdit = $_SESSION['listFormations']->chercheFormation($optID);
    if (isset($formaToEdit))
    {
        $idForma = $formaToEdit->getIdForma();
        $intitule = $formaToEdit->getIntitule();
        $descriptif = $formaToEdit->getDescriptif();
        $duree = $formaToEdit->getDuree();
        $dateOuvertureInscription = $formaToEdit->getDateOuvertureInscription();
        $dateClotureInscription = $formaToEdit->getDateClotureInscription();
        $dateDebut = $formaToEdit->getDateDebut();
        $dateFin = $formaToEdit->getDateFin();
        $effectifMax = $formaToEdit->getEffectifMax();

        $viewForm = new Formulaire("post", "index.php", "fInscFormation", "form");

        $viewForm->ajouterComposantLigne($viewForm->creerID("idForma", $idForma, ""), "WW");

        $viewForm->ajouterComposantLigne($viewForm->creerTitre("titre", "Intitule :" . $intitule . ""), "1");


        $viewForm->ajouterComposantLigne($viewForm->creerCorp("corps", $descriptif), "1");



        $data = array (
            array("Duree : ",$duree,'heurs'),
            array("Effectif Max :",$effectifMax,'personnes'),
            //Ouverture //Cloture
            array("-",'Ouverture','Cloture'),
            array("Inscription :",$dateOuvertureInscription,$dateClotureInscription),
            //Debut //Fin
            array("-",'Debut','Fin'),
            array("Formation :",$dateFin,$dateFin)
        );

        $tabDetailsForma = new Tableau(1,$data);
        $tabDetailsForma->setTitreTab("Details Formation");


        $viewForm->ajouterComposantTab();


        $viewForm->creerArticle2();
    }

} // creation du formulaire static pour afficher une formations dont l'id est passer en parametre
else if ($option == "supprimer") {
    $optID = null;
    $optID = $_SESSION['formaID'];
    $formaToEdit = $_SESSION['listFormations']->chercheFormation($optID);
    if(isset($formaToEdit)) // verifie si la formation existe
    {
        //supprime la formation passer en parametre
        FormationDAO::supprimerFormation($optID);
        $message = "La formation a bien ete supprimer";
    }
    else
    {
        $message = "La formation n'a pas ete trouver !!";
    }
} // suppresion d'une formations dont l'id est passer en parametre
else if ($option == "gererFormations") {
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
                                <td>Nom</td>
                                <td>Description</td>
                                <td>Duree</td>
                                <td>Date Ouverture Insc</td>
                                <td>Date Cloture Insc</td> 
                                <td>Date Debut</td>
                                <td>Date Fin</td>
                                <td>Max</td>
                                <td>Details</td>
                                <td>Modifier</td>
                                <td>Supprimer</td></tr>
                        </thead>";

        foreach ($_SESSION['listFormations']->getFormations() as $uneFormation) {
            $composant .= '<tr class="pair" >';

            $composant .= "<td>" . $uneFormation->getIntitule() . "</td>";
            $composant .= "<td>" . substr($uneFormation->getDescriptif(), 0, 20) . "</td>"; // seulement les 20 caractere de la description pour ne pas deformer le tableau
            $composant .= "<td>" . $uneFormation->getDuree() . "</td>";
            $composant .= "<td>" . $uneFormation->getDateOuvertureInscription() . "</td>";
            $composant .= "<td>" . $uneFormation->getDateClotureInscription() . "</td>";
            $composant .= "<td>" . $uneFormation->getDateDebut() . "</td>";
            $composant .= "<td>" . $uneFormation->getDateFin() . "</td>";
            $composant .= "<td>" . $uneFormation->getEffectifMax() . "</td>";

            $id = $uneFormation->getIdForma();


            // $formModifier = '<a href="?MenuResponsablef=modifier&id='.$id.'">Modifier</a>';
            $formModifier = '<a href="?MenuResponsablef=afficher&id=' . $id . '"><input type="button" value="Voir la formation"/></a>';
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


} // creation du tableau CRUD des formations
else if ($option == "gererDemandes") {

    function creerFormulaireDemande($uneFormation, $listeDemandesEffectues, $listeUtilisateurs)
    {

//        $idForma = $uneFormation->getIdForma();
        $lablIntitule = $uneFormation->getIntitule();
        $lablDescriptif = $uneFormation->getDescriptif();
//        $labdateOuvertureInscription = $uneFormation->getIdForma();
//        $labdateClotureInscription = $uneFormation->getIdForma();
        $dateDebut = $uneFormation->getDateDebut();
//        $dateFin = $uneFormation->getDateFin();
//        $lableffectifMax = $uneFormation->getIdForma();
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
                                <td>Etat Inscription</td>
                                <td>Date Inscription</td>		
                                <td>Date Debut Formation</td>		
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
                $composant .= "<td>" . $dateDebut . "</td>";


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

} // creation du tableau de gestion des demandes pour les formations


require_once 'vue/vueResponsablef.php';
