<?php

$_SESSION['listLigues'] = new LiguesDTO(LigueDAO::lesLigues());
$_SESSION['listClubs'] = new ClubsDTO(ClubDAO::lesClubs());

if (isset($_GET['MenuSecretaire'])) {
    $_SESSION['MenuSecretaire'] = $_GET['MenuSecretaire'];
    if (isset($_GET['id'])) {
        $_SESSION['ligueID'] = $_GET['id'];

    }
} else {
    if (!isset($_SESSION['MenuSecretaire'])) {
        $_SESSION['MenuSecretaire'] = "ajouter";
    }
}

// Créer un menu vertical

$menuSecretaire = new menu("menuSecretaire");

$menuSecretaire->ajouterComposant($menuSecretaire->creerItemLien("ajouter", "Nouvelle Ligue"));
$menuSecretaire->ajouterComposant($menuSecretaire->creerItemLien("ligues", "Gerer les Ligues"));

$leMenuSecretaire = $menuSecretaire->creerMenu2($_SESSION['MenuSecretaire'], 'MenuSecretaire', "Les Ligues");

$option = $_SESSION['MenuSecretaire'];
if ($option == "ajouter") {
    $unformulaire = new Formulaire("post", "index.php", "fNewLigue", "fNewLigue");
    $unformulaire->ajouterComposantLigne($unformulaire->creerTitre("titre", "Ajouter une formations"), "1");

    $unformulaire->ajouterComposantLigne($unformulaire->creerLabel('Nom : '));
    $unformulaire->ajouterComposantLigne($unformulaire->creerInputTexte('nom', 'nom', '', 1, 'Entrez un nom de ligue', ''));
    $unformulaire->ajouterComposantLigne($unformulaire->creerBr());

    $unformulaire->ajouterComposantLigne($unformulaire->creerLabel('Site : '));
    $unformulaire->ajouterComposantLigne($unformulaire->creerInputTexte('site', 'site', '', 1, 'Entrez un lien vers le site', ''));
    $unformulaire->ajouterComposantLigne($unformulaire->creerBr());

    $unformulaire->ajouterComposantLigne($unformulaire->creerLabel('Descriptif : '));
    $unformulaire->ajouterComposantLigne($unformulaire->creerInputTexte('descriptif', 'descriptif', '', 1, 'Entrez un descriptif', ''));
    $unformulaire->ajouterComposantLigne($unformulaire->creerBr());

    $unformulaire->ajouterComposantLigne($unformulaire->creerInputSubmit('submitNewLigue', 'submitNewLigue', " Créer la Ligue "));

    $unformulaire->ajouterComposantTab();
    $unformulaire->creerArticle();
} 
else if ($option == "ligues") {
    $gestForma = new Formulaire("post", "index.php", "lConnexion", "lConnexion");
    $gestForma->ajouterComposantLigne($gestForma->creerTitre("titre", "Gérer les Ligues "), "1");
    $gestForma->ajouterComposantTab();
    $gestForma->creerArticle();

    function afficherTableauCRUD()
    {
        $composant = "<div class='article'><div class='corps'>
            <table class='tab'>
                        <thead>
                            <tr>
                                <td>Nom</td>
                                <td>Lien</td>
                                <td>Descriptif</td>
                            <td>Détails</td>
                            <td>Modifier</td>
                            <td>Supprimer</td></tr>
                        </thead>";

        foreach ($_SESSION['listLigues']->getLigues() as $uneLigue) {
            $composant .= '<tr class="pair" >';

            $composant .= "<td>" . $uneLigue->getNomLigue() . "</td>";
            $composant .= "<td>" . $uneLigue->getSite() . "</td>";
            $composant .= "<td>" . $uneLigue->getDescriptif() . "</td>";

            $id = $uneLigue->getIdLigue();

            $formModifier = '<a href="?MenuSecretaire=ligues&id=' . $id . '"><input type="button" value="Voir la ligue"/></a>';
            $composant .= "<td>" . $formModifier . "</td>";

            $formModifier = '<a href="?MenuSecretaire=modifier&id=' . $id . '"><input type="button" value="Modifier"/></a>';
            $composant .= "<td>" . $formModifier . "</td>";

            $formSupprimer = '<a href="?MenuSecretaire=supprimer&id=' . $id . '"><input type="button" value="Supprimer"/></a>';
            $composant .= "<td>" . $formSupprimer . "</td>";

            $composant .= "</tr>";
        }

        $composant .= "</table></div></div>";

        echo $composant;
    }
}

else if ($option == "modifier") {
    $idLigue = $_SESSION['ligueID'];
    $formaToEdit = $_SESSION['listLigues']->chercheLigue($idLigue);

    $idForma = $formaToEdit->getIdLigue();
    $nom = $formaToEdit->getNomLigue();
    $site = $formaToEdit->getSite();
    $descriptif = $formaToEdit->getDescriptif();

    $editForm = new Formulaire("post", "index.php", "fEditLigue", "fEditLigue");
    $editForm->ajouterComposantLigne($editForm->creerTitre("titre", "Modifier la ligue : " . $nom), "1");

    $editForm->ajouterComposantLigne($editForm->creerID("idForma", $idForma, ""), "WW");

    $editForm->ajouterComposantLigne($editForm->creerLabel('nom :'));
    $editForm->ajouterComposantLigne($editForm->creerInputTexte('nom', 'nom', $nom, 1, 'Entrez un nom de ligue', ''));
    $editForm->ajouterComposantLigne($editForm->creerBr());

    $editForm->ajouterComposantLigne($editForm->creerLabel('site :'));
    $editForm->ajouterComposantLigne($editForm->creerInputTexte('site', 'site', $site, 1, 'Entrez un lien vers le site', ''));
    $editForm->ajouterComposantLigne($editForm->creerBr());

    $editForm->ajouterComposantLigne($editForm->creerLabel('descriptif :'));
    $editForm->ajouterComposantLigne($editForm->creerInputTexte('descriptif', 'descriptif', $descriptif, 1, 'Entrez un descriptif', ''));
    $editForm->ajouterComposantLigne($editForm->creerBr());

    $editForm->ajouterComposantLigne($editForm->creerInputSubmit('submitEditLigue', 'submitEditLigue', " Modifier la ligue "));


    $editForm->ajouterComposantTab();
    $editForm->creerArticle();
}

else if ($option == "supprimer") {
    $idLigue = null;
    $idLigue = $_SESSION['ligueID'];
    LigueDAO::supprimerLigue($idLigue);
    $message = "La ligue a bien été supprimée";
}

// if(isset($_POST['submitNewForma'])){
//     LigueDAO::nouvelleLigue($_POST['nomLigue'],$_POST['site'],$_POST['descriptif']);
// }

require_once 'vue/vueSecretaire.php' ;