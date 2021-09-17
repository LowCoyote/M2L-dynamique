<?php
class FormationDAO
{
    public static function lesFormations(){
        $result = [];
        $requetePrepa = DBConnex::getInstance()->prepare("SELECT * FROM `Formation` ORDER BY `Formation`.`idForma` ASC" );

        $requetePrepa->execute();
        $liste = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($liste)){
            foreach($liste as $formation){
                $uneFormation = new FormationDTO(null,null,null,null,null,null,null);
                $uneFormation->hydrate($formation);
                $result[] = $uneFormation;
            }
        }
        return $result;
    }
}