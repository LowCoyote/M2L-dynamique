<?php
<<<<<<< Updated upstream

class UtilisateurDAO
{
    public static function verification(UtilisateurDTO $utilisateur){

        $requetePrepa = DBConnex::getInstance()->prepare("select * from utilisateur where 
        login = :login and  mdp = md5(:mdp)");

        $login = $utilisateur->getLogin();
        $mdp =   $utilisateur->getMdp();


        $requetePrepa->bindParam( ":login",$login);
        $requetePrepa->bindParam( ":mdp" ,  $mdp);

<<<<<<< HEAD
        $requetePrepa->execute();
=======
    public static function verification(UtilisateurDTO $utilisateur){

        $requetePrepa = DBConnex::getInstance()->prepare("select login from utilisateur where 
        login = :login and  mdp = md5(:mdp)");

        $login = $utilisateur->getLogin();
        $mdp =   $utilisateur->getMdp();

=======
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
>>>>>>> Stashed changes


    public static function getUtilisateur($username){
        $requetePrepa = DBConnex::getInstance()->prepare("select idUser, nom, prenom, login, statut, typeUser, idFonct, idLigue, idClub from Utilisateur where login=:login");
        $requetePrepa->bindParam(':login', $username);
        $requetePrepa->execute();
        $result = $requetePrepa->fetch(PDO::FETCH_ASSOC);
        
        return $result;
    }
<<<<<<< Updated upstream
>>>>>>> 334e40ed392427de192d8e28af762a1537ae4427

        $login = $requetePrepa->fetch(PDO::FETCH_NUM);
        if(empty($login[0])){
            return False;
        }
        else{
            return $login;
        }
    }
=======
>>>>>>> Stashed changes
}