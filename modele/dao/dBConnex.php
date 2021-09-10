<?php
class DBConnex extends PDO{
    
    private static $instance;
    
    public static function getInstance(){
        if ( !self::$instance ){
            self::$instance = new DBConnex();
        }
        return self::$instance;
    }
    
    private function __construct(){
        try {
            parent::__construct(Param::$dsn ,Param::$user, Param::$pass);
        } catch (Exception $e) {
            echo $e->getMessage();
            die("Impossible de se connecter. " );
        }
    }

    //Fonction qui renvoie un booléen si le login de l'utilisateur a été trouvée 
    public static function verifLogin($instance, $login){
        try{
            $requete = $instance->prepare("select count(*) from Utilisateur where login=:login");
            $requete->bindParam(':login', $login);
            $requete->execute();
            $authentification = $requete->fetch(PDO::FETCH_NUM);
            if(empty($authentification[0])){
                return False;
            }
            else{
                return True;
            }
        }
        catch(Exception $ex)
        {
            echo($ex -> getMessage());
        }
    }

    //Fonction qui renvoie le mot de passe chiffrer de l'utilisateur
    public static function verifMdp($instance, $login){
        try{
            $requete = $instance->prepare("select Password from user where login=:login");
            $requete->bindParam(':login', $login);
            $requete->execute();
            $data = $requete->fetchColumn();
            return $data;
        }
        catch(Exception $ex)
        {
            echo($ex -> getMessage());
        }
    }
    

}