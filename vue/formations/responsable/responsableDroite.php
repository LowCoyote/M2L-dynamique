<div class="articles">
    <?php

    if ($option == "ajouter") {
        $unformulaire->afficherFormulaire();
        echo '<br><input type="button" value="Retour sur la page precedente !" onclick="history.back()">';
    }
    else if ($option == "modifier") {
        $editForm->afficherFormulaire();
        echo '<br><input type="button" value="Retour sur la page precedente !" onclick="history.back()">';
    }
    else if ($option == "formation") {
        $viewForm->afficherFormulaire();
        echo '<br><br><input type="button" value="Retour sur la page precedente !" onclick="history.back()">';

    }
    else if ($option == "supprimer") {
        echo '<br><br> ';
        echo $message;
        echo '<br><br><input type="button" value="Retour sur la page precedente !" onclick="history.back()">';
    }
    else if ($option == "succes") {
        echo '<br><br> ';
        if (isset($_GET["message"])) {
            echo $_GET["message"];
        }
        echo '<br><br><input type="button" value="Retour sur la page precedente !" onclick="history.back()">';
    }
    else if ($option == "formations") {
        $gestForma->afficherFormulaire();
        afficherTableauCRUD();
        echo '<br><br><a href="index.php?MenuResponsablef=ajouter"><input type="button" value="Nouvelle formations!" href="index.php?MenuResponsablef=ajouter"></a>';

    }
    else if ($option == "demandes") {
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
    else {
        echo '<br><br> ';
        echo "page introuvable";
        echo '<br><br><input type="button" value="Retour sur la page precedente !" onclick="history.back()">';
    }

    ?>
</div>
