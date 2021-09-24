<?php


class FormationsDTO
{
    private $formations= array();

    public function __construct($array){
        if (is_array($array)) {
            $this->formations = $array;
        }
    }

    public function getFormations(){
        return $this->formations;
    }

    public function chercheFormation($unNumFormation){
        $i = 0;
        while ($unNumFormation != $this->formations[$i]->getIdForma() && $i < count($this->formations)-1){
            $i++;
        }
        if ($unNumFormation == $this->formations[$i]->getIdForma()){
            return $this->formations[$i];
        }
    }



}