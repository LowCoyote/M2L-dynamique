<?php
/*****************************************************************************************************
 * Instancier un objet contenant la liste des Equipes et le conserver dans une variable de session
 *****************************************************************************************************/
$_SESSION['listFormations'] = new FormationDTO(FormationDAO::lesFormations());


require_once 'vue/vueFormations.php';
//var_dump($_SESSION['listFormations']);
