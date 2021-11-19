<?php


class ClubsDTO
{
    private $clubs= array();

    public function __construct($array){
        if (is_array($array)) {
            $this->clubs = $array;
        }
    }

    public function getClubs(){
        return $this->clubs;
    }

    public function chercheClub($unNumClub){
        $i = 0;
        while ($unNumClub != $this->clubs[$i]->getIdLigue() && $i < count($this->clubs)-1){
            $i++;
        }
        if ($unNumClub == $this->clubs[$i]->getIdLigue()){
            return $this->clubs[$i];
        }
    }


}