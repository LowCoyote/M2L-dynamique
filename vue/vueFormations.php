<div class="conteneur">
    <header>
        <?php include 'haut.php' ;?>
    </header>
    <main>
        <div class='gauche'>
            <?php include 'vue/formations/formationsGauche.php';
            ?>
        </div>
        <div class='droite'>
            <?php include 'vue/formations/formationsDroite.php';
//            var_dump($_SESSION['demandeInscription']);
            ?>

        </div>
    </main>
    <footer>
        <?php include 'bas.php' ;?>
    </footer>
</div>
