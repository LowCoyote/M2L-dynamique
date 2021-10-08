<div class="conteneur">
	<header>
		<?php include 'haut.php' ;?>
	</header>

	<main>
        <div class="contentSalarie">
            <div class='titre'>Voici vos informations</div>
                <div class="gauche-tab">
<<<<<<< Updated upstream
                    <?php afficherTableauIntervenant(); ?>
=======
                    <?php afficherTableauIntervenant(); 
                        afficherTableauBulletin();
                    ?>
>>>>>>> Stashed changes
                </div>
            <div class="droite-tab" style="margin-top: 17px;">
            </div>
        </div>
	</main>
	<footer>
		<?php include 'bas.php' ;?>
	</footer>
</div>