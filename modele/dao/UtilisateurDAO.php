<?php


class UtilisateurDAO
{
    use Hydrate;

    public static function lesUtilisateurs(){
        $result = [];
        $requetePrepa = DBConnex::getInstance()->prepare("SELECT * FROM `utilisateur`" );
        $requetePrepa->execute();
        $liste = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($liste)){
            foreach($liste as $utilisateur){
                $unUtilisateur = new UtilisateurDTO();
                $unUtilisateur->hydrate($utilisateur);
                $result[] = $unUtilisateur;
            }
        }
        return $result;
    }

    public static function verificationUtilisateur(UtilisateurDTO $utilisateur){

        $requetePrepa = DBConnex::getInstance()->prepare("select mail from Utilisateur where
        mail = :mail and  mdp = md5(:mdp)");

        $mail = $utilisateur->getLogin();
        $mdp =   $utilisateur->getMdp();


        $requetePrepa->bindParam( ":mail",$mail);
        $requetePrepa->bindParam( ":mdp" ,  $mdp);

        $requetePrepa->execute();

        $mail = $requetePrepa->fetch();

        return $mail[0];
    }

    public static function verificationUtilisateur2(UtilisateurDTO $utilisateur){

        $requetePrepa = DBConnex::getInstance()->prepare("select utilisateur from `utilisateur` where 
        login = :login and  mdp = md5(:mdp)");


        $login = $utilisateur->getLogin();
        $mdp =   $utilisateur->getMdp();

        $requetePrepa->bindParam( ":login",$login);
        $requetePrepa->bindParam( ":mdp" ,  $mdp);

        $requetePrepa->execute();

        $login = $requetePrepa->fetch();
        return $login[0];
    }


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
}