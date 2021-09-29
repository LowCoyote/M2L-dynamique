<?php
use Hydrate;

class UtilisateurDAO
{
    public static function verification($username, $mdp){
        $requetePrepa = DBConnex::getInstance()->prepare("select count(*) from Utilisateur where login=:login and mdp =md5(:mdp)");
        $requetePrepa->bindParam(':login', $username);
        $requetePrepa->bindParam(':mdp', $mdp);
        $requetePrepa->execute();
        $authentification = $requetePrepa->fetch(PDO::FETCH_NUM);
        if(empty($authentification[0])){
            return False;
        }
        else{
            return True;
        }
    }
    public static function getStatus($username){
        $result = [];
        $requetePrepa = DBConnex::getInstance()->prepare("select statut from Utilisateur where login=:login");
        $requetePrepa->bindParam(':login', $username);
        $requetePrepa->execute();
   
        $result = $requetePrepa->fetch(); 

        return $result;
    }


    public static function getUtilisateur($username){
        $requetePrepa = DBConnex::getInstance()->prepare("select idUser, nom, prenom, login, statut, typeUser, idFonct, idLigue, idClub from Utilisateur where login=:login");
        $requetePrepa->bindParam(':login', $username);
        $requetePrepa->execute();
        $result = $requetePrepa->fetch(PDO::FETCH_ASSOC);
        
        return $result;
    }

    public static function getContrat($idUser){
        $requetePrepa = DBConnex::getInstance()->prepare("select dateDebut, dateFin, typeContrat, nbHeures from Contrat where idUser=:idUser");
        $requetePrepa->bindParam(':idUser', $idUser);
        $requetePrepa->execute();
        $result = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

    public static function getIdContrat($idUser){
        $requetePrepa = DBConnex::getInstance()->prepare("select idContrat from Contrat where idUser=:idUser");
        $requetePrepa->bindParam(':idUser', $idUser);
        $requetePrepa->execute();
        $result = $requetePrepa->fetch(PDO::FETCH_ASSOC)["idContrat"];
        
        return $result;
    }

    public static function getBulletin($idContrat){
<<<<<<< Updated upstream
        $requetePrepa = DBConnex::getInstance()->prepare("select buletinPDF from Buletin where idContrat=:idContrat");
=======
        $requetePrepa = DBConnex::getInstance()->prepare("select bulletinPDF from Bulletin where idContrat=:idContrat");
>>>>>>> Stashed changes
        $requetePrepa->bindParam(':idContrat', $idContrat);
        $requetePrepa->execute();
        $result = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
<<<<<<< Updated upstream
=======

    public static function getIntervenants(){
        $idFonct = 1;
        $requetePrepa = DBConnex::getInstance()->prepare("select idUser, nom, prenom, login, statut, typeUser, fonction.libelle, idLigue, idClub from Utilisateur,fonction where fonction.idFonct =:idFonct and fonction.idFonct = utilisateur.idFonct        ");
        $requetePrepa->bindParam(':idFonct', $idFonct);
        $requetePrepa->execute();
        $result = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

    public static function getAllnom(){
        $requetePrepa = DBConnex::getInstance()->prepare("select nom from Utilisateur ");
        $requetePrepa->execute();
        $result = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
>>>>>>> Stashed changes
}