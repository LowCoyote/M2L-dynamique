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

    public static function effectuerDemandeForma($idForm, $idUser) {
        //
        $requetePrepa = DBConnex::getInstance()->prepare("INSERT INTO `effectue` (`idForma`, `idUser`, `EtatInscription`, `DateInscription`) VALUES (:idForm, :idUser, 'EN COURS', CURRENT_TIMESTAMP);");
        $requetePrepa->bindParam( ":idForm", $idForm);
        $requetePrepa->bindParam( ":idUser", $idUser);
        $requetePrepa->execute();

    }

    public static function supprimerDemandeForma($idForm, $idUser) {
        //DELETE FROM `effectue` WHERE `effectue`.`idForma` = 2 AND `effectue`.`idUser` = 1"
        $requetePrepa = DBConnex::getInstance()->prepare("DELETE FROM `effectue` WHERE `effectue`.`idForma` = :idForm AND `effectue`.`idUser` = :idUser;");
        $requetePrepa->bindParam( ":idForm", $idForm);
        $requetePrepa->bindParam( ":idUser", $idUser);
        $requetePrepa->execute();

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