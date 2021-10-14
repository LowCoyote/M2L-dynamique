<?php
class FormationDAO
{
    public static function lesFormations(){
        $result = [];
        $requetePrepa = DBConnex::getInstance()->prepare("SELECT * FROM `Formation` ORDER BY `Formation`.`idForma` ASC" );

        $requetePrepa->execute();
        $liste = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($liste)){
            foreach($liste as $formation){
                $uneFormation = new FormationDTO(null,null,null,null,null,null,null);
                $uneFormation->hydrate($formation);
                $result[] = $uneFormation;
            }
        }
        return $result;
    }

    public static function lesFormationsDEffectues(){
        $result = [];
        $requetePrepa = DBConnex::getInstance()->prepare("SELECT * FROM `formation` WHERE `idForma` in (SELECT `effectue`.`idForma` FROM `effectue`) AND dateOuvertureInscription <= CURRENT_TIMESTAMP AND dateClotureInscription >= CURRENT_TIMESTAMP ORDER BY `Formation`.`idForma` ASC" );

        $requetePrepa->execute();
        $liste = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($liste)){
            foreach($liste as $formation){
                $uneFormation = new FormationDTO(null,null,null,null,null,null,null);
                $uneFormation->hydrate($formation);
                $result[] = $uneFormation;
            }
        }
        return $result;
    }

    public static function nouvelleFormation($intitule, $descriptif, $duree, $dateOuvertureInscription, $dateClotureInscription, $effectifMax) {

        $requetePrepa = DBConnex::getInstance()->prepare("INSERT INTO `formation` (`idForma`, `intitule`, `descriptif`, `duree`, `dateOuvertureInscription`, `dateClotureInscription`, `effectifMax`) VALUES (NULL, :intitule, :descriptif, :duree, :dateOuvertureInscription, :dateClotureInscription, :effectifMax);");
        $requetePrepa->bindParam( ":intitule", $intitule);
        $requetePrepa->bindParam( ":descriptif", $descriptif);
        $requetePrepa->bindParam( ":duree", $duree);
        $requetePrepa->bindParam( ":dateOuvertureInscription", $dateOuvertureInscription);
        $requetePrepa->bindParam( ":dateClotureInscription", $dateClotureInscription);
        $requetePrepa->bindParam( ":effectifMax", $effectifMax);
        $requetePrepa->execute();

    }

    public static function modifierFormation($idForma, $intitule, $descriptif, $duree, $dateOuvertureInscription, $dateClotureInscription, $effectifMax) {

        $requetePrepa = DBConnex::getInstance()->prepare("UPDATE `formation` SET `intitule` = :intitule, `descriptif` = :descriptif, `duree` = :duree, `dateOuvertureInscription` = :dateOuvertureInscription, `dateClotureInscription` = :dateClotureInscription, `effectifMax` = :effectifMax WHERE `formation`.`idForma` = :idForma;");
        $requetePrepa->bindParam( ":idForma", $idForma);
        $requetePrepa->bindParam( ":intitule", $intitule);
        $requetePrepa->bindParam( ":descriptif", $descriptif);
        $requetePrepa->bindParam( ":duree", $duree);
        $requetePrepa->bindParam( ":dateOuvertureInscription", $dateOuvertureInscription);
        $requetePrepa->bindParam( ":dateClotureInscription", $dateClotureInscription);
        $requetePrepa->bindParam( ":effectifMax", $effectifMax);
        $requetePrepa->execute();

    }

    public static function supprimerFormation($idForma) {

        $requetePrepa = DBConnex::getInstance()->prepare("DELETE FROM `formation` WHERE `formation`.`idForma` = :idForma;");
        $requetePrepa->bindParam( ":idForma", $idForma);
        $requetePrepa->execute();

        $requetePrepa1 = DBConnex::getInstance()->prepare(" DELETE FROM `effectue` WHERE `effectue`.`idForma` = :idForma;");
        $requetePrepa1->bindParam( ":idForma", $idForma);
        $requetePrepa1->execute();
    }

    public static function verifierDemandeInscrit($idForm, $idUser){
        $requetePrepa = DBConnex::getInstance()->prepare("SELECT  `EtatInscription`, `DateInscription` FROM `effectue` WHERE `idForma` = :idForm AND `idUser` = :idUser;");
        $requetePrepa->bindParam( ":idForm", $idForm);
        $requetePrepa->bindParam( ":idUser", $idUser);
        $requetePrepa->execute();
        $result = $requetePrepa->fetch(PDO::FETCH_ASSOC);

        return $result;
    }


}