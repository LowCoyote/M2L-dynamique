<div class="conteneur">
    <header>
        <?php include 'haut.php' ;?>
    </header>

    <main class='test'>
        <div class="contentSalarieResp">
            <div class="gauche-tab">
                <?php afficherTableauIntervenant();
                afficherTableauBulletin();
                ?>
            </div>
            <div class="droite-tab" style="margin-top: 17px;">
            </div>
        </div>
    </main>
    <style>
        th,
        td {
            padding: 3px;
            background-color: rgba(255,255,255,0.2);
            color: #fff;
        }

        th {
            text-align: left;
        }
        thead th {
            background-color: #55608f;
        }
        tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }
        tbody td {
            position: relative;
        }
        tbody td:hover:before {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            top: -9999px;
            bottom: -9999px;
            background-color: rgba(255, 255, 255, 0.2);
            z-index: -1;
        }
    </style>
    <footer>
        <?php include 'bas.php' ;?>
    </footer>
</div>