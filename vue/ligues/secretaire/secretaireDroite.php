<div class="articles">
        <?php
               
                if ($option == "ajouter") {
                        $unformulaire->afficherFormulaire();
                        echo '<br><input type="button" value="Retour" onclick="history.back()">';
                }
                else if ($option == "modifier") {
                        $editForm->afficherFormulaire();
                        echo '<br><input type="button" value="Retour" onclick="history.back()">';
                }
                else if ($option == "ligues") {
                        $gestForma->afficherFormulaire();
                        afficherTableauCRUD();
                        echo '<br><br><a href="index.php?MenuSecretaire=ajouter"><input type="button" value="Nouvelle Ligue" href="index.php?MenuSecretaire=ajouter"></a>';
                
                    }
                else if ($option == "supprimer") {
                        echo '<br><br> ';
                        echo $message;
                        echo '<br><br><input type="button" value="Retour" onclick="history.back()">';
                }
        ?>
</div>
