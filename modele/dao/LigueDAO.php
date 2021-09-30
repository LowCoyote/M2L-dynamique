<?php


class LigueDAO
{
    public static function lesLigues(){
        $result = [];
        $requetePrepa = DBConnex::getInstance()->prepare("SELECT * FROM `ligue` ORDER BY `ligue`.`idLigue` ASC" );

        $requetePrepa->execute();
        $liste = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($liste)){
            foreach($liste as $ligue){
                $uneLigue = new LigueDTO(null,null,null,null,null,null,null);
                $uneLigue->hydrate($ligue);
                $result[] = $uneLigue;
            }
        }
        return $result;
    }


}