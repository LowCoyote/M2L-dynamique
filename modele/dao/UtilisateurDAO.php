<?php


class UtilisateurDAO
{

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

}
