<?php
class ClubDAO
{
    public static function lesClubs(){
        $result = [];
        $requetePrepa = DBConnex::getInstance()->prepare("SELECT * FROM `Club` ORDER BY `Club`.`idClub` ASC" );

        $requetePrepa->execute();
        $liste = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($liste)){
            foreach($liste as $club){
                $unClub = new ClubDTO(null,null,null,null,null);
                $unClub->hydrate($club);
                $result[] = $unClub;
            }
        }
        return $result;
    }
}