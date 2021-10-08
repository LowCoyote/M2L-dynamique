<?php
<<<<<<< Updated upstream
use Hydrate;
=======
>>>>>>> Stashed changes

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
<<<<<<< Updated upstream


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
=======


    public static function getUtilisateur($username){
        $requetePrepa = DBConnex::getInstance()->prepare("select idUser, nom, prenom, login, statut, typeUser, idFonct, idLigue, idClub from Utilisateur where login=:login");
        $requetePrepa->bindParam(':login', $username);
        $requetePrepa->execute();
        $result = $requetePrepa->fetch(PDO::FETCH_ASSOC);
>>>>>>> Stashed changes
        
        return $result;
    }

<<<<<<< Updated upstream
    public static function getIdContrat($idUser){
        $requetePrepa = DBConnex::getInstance()->prepare("select idContrat from Contrat where idUser=:idUser");
        $requetePrepa->bindParam(':idUser', $idUser);
        $requetePrepa->execute();
        $result = $requetePrepa->fetch(PDO::FETCH_ASSOC)["idContrat"];
=======
    public static function getContrat($idUser){
        $requetePrepa = DBConnex::getInstance()->prepare("select dateDebut, dateFin, typeContrat, nbHeures from Contrat where idUser=:idUser");
        $requetePrepa->bindParam(':idUser', $idUser);
        $requetePrepa->execute();
        $result = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);
>>>>>>> Stashed changes
        
        return $result;
    }

<<<<<<< Updated upstream
    public static function getBulletin($idContrat){
        $requetePrepa = DBConnex::getInstance()->prepare("select bulletinPDF from Bulletin where idContrat=:idContrat");
        $requetePrepa->bindParam(':idContrat', $idContrat);
        $requetePrepa->execute();
        $result = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);
=======
    public static function getIdContrat($idUser){
        $requetePrepa = DBConnex::getInstance()->prepare("select idContrat from Contrat where idUser=:idUser");
        $requetePrepa->bindParam(':idUser', $idUser);
        $requetePrepa->execute();
        $result = $requetePrepa->fetch(PDO::FETCH_ASSOC)["idContrat"];
>>>>>>> Stashed changes
        
        return $result;
    }

<<<<<<< Updated upstream
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
=======
    public static function getBulletin($idContrat){
        $requetePrepa = DBConnex::getInstance()->prepare("select bulletinPDF from Buletin where idContrat=:idContrat");
        $requetePrepa->bindParam(':idContrat', $idContrat);
>>>>>>> Stashed changes
        $requetePrepa->execute();
        $result = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

<<<<<<< Updated upstream
    public static function SuppIntervenants($idUser){
        $requetePrepa = DBConnex::getInstance()->prepare("DELETE FROM Utilisateur where idUser=:idUser");
        $requetePrepa->bindParam(':idUser', $idUser);
=======
    public static function getIntervenants(){
        $idFonct = 1;
        $requetePrepa = DBConnex::getInstance()->prepare("select Utilisateur.idUser, nom, prenom, login, statut, typeUser, Fonction.libelle, idLigue, idClub , bulletinPDF from Utilisateur,Fonction, Contrat, Buletin where Fonction.idFonct = 1 and Fonction.idFonct = Utilisateur.idFonct and Contrat.idUser = Utilisateur.idUser and Contrat.idContrat = Buletin.idContrat");
        $requetePrepa->bindParam(':idFonct', $idFonct);
>>>>>>> Stashed changes
        $requetePrepa->execute();
        $result = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

<<<<<<< Updated upstream
    public static function modifIntervenant($idUser, $nom, $prenom, $login, $statut, $typeUser)
    {
        //idUser nom prenom login statut typeUser
        $requetePrepa = DBConnex::getInstance()->prepare("UPDATE Utilisateur SET nom=:nom , prenom=:prenom, nom=:nom , login=:login, statut=:statut , typeUser=:typeUser where idUser=:idUser");
        $requetePrepa->bindParam(':idUser', $idUser);
        $requetePrepa->bindParam(':nom', $nom);
        $requetePrepa->bindParam(':prenom', $prenom);
        $requetePrepa->bindParam(':login', $login);
        $requetePrepa->bindParam(':statut', $statut);
        $requetePrepa->bindParam(':typeUser', $typeUser);

=======
    public static function getAllnom(){
        $requetePrepa = DBConnex::getInstance()->prepare("select nom from Utilisateur ");
>>>>>>> Stashed changes
        $requetePrepa->execute();
        $result = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
}