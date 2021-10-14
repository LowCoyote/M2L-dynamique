<?php
class EffectueDAO
{
    public static function lesDemandesEffectues(){
        $result = [];
        $requetePrepa = DBConnex::getInstance()->prepare("SELECT * FROM `effectue`" );

        $requetePrepa->execute();
        $liste = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($liste)){
            foreach($liste as $effectue){
                $uneEffectue = new EffectueDTO();
                $uneEffectue->hydrate($effectue);
                $result[] = $uneEffectue;
            }
        }
        return $result;
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

    public static function accepterDemandeForma($idForm, $idUser) {
        //
        $requetePrepa = DBConnex::getInstance()->prepare("UPDATE `effectue` SET `EtatInscription` = 'VALIDÉE' WHERE `effectue`.`idForma` = :idForm AND `effectue`.`idUser` = :idUser;");
        $requetePrepa->bindParam( ":idForm", $idForm);
        $requetePrepa->bindParam( ":idUser", $idUser);
        $requetePrepa->execute();

    }

    public static function refuserDemandeForma($idForm, $idUser) {
        //
        $requetePrepa = DBConnex::getInstance()->prepare("UPDATE `effectue` SET `EtatInscription` = 'REFUSÉE' WHERE `effectue`.`idForma` = :idForm AND `effectue`.`idUser` = :idUser;");
        $requetePrepa->bindParam( ":idForm", $idForm);
        $requetePrepa->bindParam( ":idUser", $idUser);
        $requetePrepa->execute();

    }

    public static function nbValideeDemandeForma($idForm) {
        //
        $requetePrepa = DBConnex::getInstance()->prepare("SELECT count(*) FROM `effectue` WHERE `effectue`.`EtatInscription` = 'VALIDÉE' AND`effectue`.`idForma` = :idForm;");
        $requetePrepa->bindParam( ":idForm", $idForm);
        $requetePrepa->execute();
        $count = $requetePrepa->fetchColumn();

        return $count;
    }


}