<?php

class EffectuesDTO
{
    private $effectues= array();

    public function __construct($array){
        if (is_array($array)) {
            $this->effectues = $array;
        }
    }

    public function getEffectues(){
        return $this->effectues;
    }

    public function chercheEffectue($unNumEffectue){
        $i = 0;
        while ($unNumEffectue != $this->effectues[$i]->getIdForma() && $i < count($this->effectues)-1){
            $i++;
        }
        if ($unNumEffectue == $this->effectues[$i]->getIdForma()){
            return $this->effectues[$i];
        }
    }



}