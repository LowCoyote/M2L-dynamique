<?php

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


        $requetePrepa->bindParam( ":login",$login);
        $requetePrepa->bindParam( ":mdp" ,  $mdp);

        $requetePrepa->execute();

        $login = $requetePrepa->fetch();

        return $login[0];
    }
>>>>>>> 334e40ed392427de192d8e28af762a1537ae4427

        $login = $requetePrepa->fetch(PDO::FETCH_NUM);
        if(empty($login[0])){
            return False;
        }
        else{
            return $login;
        }
    }
}