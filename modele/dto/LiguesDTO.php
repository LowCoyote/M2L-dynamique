<?php


class LiguesDTO
{
    private $ligues= array();

    public function __construct($array){
        if (is_array($array)) {
            $this->$ligues = $array;
        }
    }

    public function getLigues(){
        return $this->$ligues;
    }

    public function chercheLigue($unNumLigue){
        $i = 0;
        while ($unNumLigue != $this->$ligues[$i]->getIdLigue() && $i < count($this->$ligues)-1){
            $i++;
        }
        if ($unNumLigue == $this->$ligues[$i]->getIdLigue()){
            return $this->$ligues[$i];
        }
    }


}