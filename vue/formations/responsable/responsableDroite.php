<div class="articles">
    <?php

    if ($option == "ajouter") {
        if(isset($addForm))
        {
            $addForm->afficherFormulaire();
        }
        else
        {
            echo '<br><br> ';
            echo "Imposible d'ajouter une nouvelle formation!";
        }
        echo '<br><input type="button" value="Retour sur la page precedente !" onclick="history.back()">';
    } // afficher le formulaire d'ajout de nouvelles formations
    else if ($option == "modifier") {
        if(isset($editForm))
        {
            $editForm->afficherFormulaire();
        }
        else
        {
            echo '<br><br> ';
            echo "Imposible de modifier une formation!";
        }
        echo '<br><input type="button" value="Retour sur la page precedente !" onclick="history.back()">';
    } // afficher le formulaire de modification de formation
    else if ($option == "afficher") {
        if(isset($viewForm))
        {
            $viewForm->afficherFormulaire();
            $tabDetailsForma->afficherTableauCorp();
        }
        else
        {
            echo '<br><br> ';
            echo "Imposible d'afficher cette formation !!";
        }
        echo '<br><br><input type="button" value="Retour sur la page precedente !" onclick="history.back()">';

    } // afficher un formulaire static d'une formation
    else if ($option == "supprimer") {
        echo '<br><br> ';
        echo $message;
        echo '<br><br><input type="button" value="Retour sur la page precedente !" onclick="history.back()">';
    }
    else if ($option == "gererFormations") {
        if(isset($gestForma))
        {
            $gestForma->afficherFormulaire();
            afficherTableauCRUD();
        }
        else
        {
            echo '<br><br> ';
            echo "Imposible d'afficher le tableau des formations !!";
        }
        echo '<br><br><a href="index.php?MenuResponsablef=ajouter"><input type="button" value="Nouvelle formations!" href="index.php?MenuResponsablef=ajouter"></a>';

    } // afficher le tableau CRUD des formations
    else if ($option == "gererDemandes") {
        if (!empty($lesFormForma)) {
            foreach ($lesFormForma as $value) {
                if ($value != null) {
                    $value->afficherFormulaire();
                }
            }
        }
        else {
            if (isset($message)) {
                echo '<br><br> ';
                echo $message;
                echo '<br><br><input type="button" value="Retour sur la page precedente !" onclick="history.back()">';
            }
        }
    }

    else if ($option == "succes") {
        echo '<br><br> ';
        if (isset($_GET["message"])) {
            echo $_GET["message"];
        }
        echo '<br><br><input type="button" value="Retour sur la page precedente !" onclick="history.back()">';
    }

    else {
        echo '<br><br> ';
        echo "404 page introuvable";
        echo '<br><br><input type="button" value="Retour sur la page precedente !" onclick="history.back()">';
    }

    ?>
</div>
