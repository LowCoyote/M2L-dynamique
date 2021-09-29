<div class="conteneur">
	<header>
		<?php include 'haut.php' ;?>
	</header>

	<main>
        <div class="contentSalarie">
            <div class='titre'>Voici vos informations</div>
                <div class="droite-tab">
                    <?php afficherTableauIntervenant(); ?>
                </div>
            <div class="gauche-ld" style="margin-top: 17px;">
                <?php test();?>
            </div>
        </div>
	</main>
	<footer>
		<?php include 'bas.php' ;?>
	</footer>
</div>