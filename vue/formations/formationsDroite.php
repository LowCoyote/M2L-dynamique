<div class="articles">
        <?php
        if (!isset($message))
        {
            $unformulaire->afficherFormulaire();
            $tabDetailsForma->afficherTableauCorp();
        }
        else
        {
            echo '<br><br> ';
            echo $message;
            echo '<br><br><input type="button" value="Retour sur la page precedente !" onclick="history.back()">';
        }

        ?>
</div>
