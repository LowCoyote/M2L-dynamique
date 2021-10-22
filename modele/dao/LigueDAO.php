<?php
class LigueDAO
{
    public static function lesLigues(){
        $result = [];
        $requetePrepa = DBConnex::getInstance()->prepare("SELECT * FROM `Ligue` ORDER BY `Ligue`.`idLigue` ASC" );

        $requetePrepa->execute();
        $liste = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($liste)){
            foreach($liste as $ligue){
                $uneLigue = new LigueDTO(null,null,null,null);
                $uneLigue->hydrate($ligue);
                $result[] = $uneLigue;
            }
        }
        return $result;
    }

    public static function modifierLigue($idLigue, $nom, $site, $descriptif) {

        $requetePrepa = DBConnex::getInstance()->prepare("UPDATE `ligue` SET `nomLigue` = :nomLigue, `site` = :site, `descriptif` = :descriptif WHERE `formation`.`idLigue` = :idLigue;");
        $requetePrepa->bindParam( ":idLigue", $idLigue);
        $requetePrepa->bindParam( ":nomLigue", $nom);
        $requetePrepa->bindParam( ":site", $site);
        $requetePrepa->bindParam( ":descriptif", $descriptif);
        $requetePrepa->execute();

    }

    public static function nouvelleLigue($nom, $site, $descriptif) {

        $requetePrepa = DBConnex::getInstance()->prepare("INSERT INTO `ligue` (`idLigue`, `nomLigue`, `site`, `descriptif`) VALUES (NULL, :nomLigue, :site, :descriptif);");
        $requetePrepa->bindParam( ":nomLigue", $nom);
        $requetePrepa->bindParam( ":site", $site);
        $requetePrepa->bindParam( ":descriptif", $descriptif);
        $requetePrepa->execute();

    }

    public static function supprimerLigue($idLigue) {
        $requetePrepa = DBConnex::getInstance()->prepare("DELETE FROM `ligue` WHERE `idLigue` = :idLigue;");
        $requetePrepa->bindParam( ":idLigue", $idLigue);
        $requetePrepa->execute();

    }


}