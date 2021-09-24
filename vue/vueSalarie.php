<div class="conteneur">
	<header>
		<?php include 'haut.php' ;?>
	</header>
	<main>
	<div class="contentSalarie">
		<div class="gauche-tab">
			<div class='titre'>Voici vos informations</div>
			<?php $formulaireSalarie->afficherFormulaire();?>
		</div>
		<div class="droite-tab">
			<?php
				afficherTableau();
			?>
		</div>
	</main>
	<footer>
		<?php include 'bas.php' ;?>
	</footer>
</div>