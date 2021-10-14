<?php


class UtilisateursDTO
{
    private $utilisateurs= array();

    public function __construct($array){
        if (is_array($array)) {
            $this->utilisateurs = $array;
        }
    }

    public function getUtilisateurs(){
        return $this->utilisateurs;
    }

    public function chercheUtilisateur($unIdUtilisateur){
        $i = 0;
        while ($unIdUtilisateur != $this->utilisateurs[$i]->getIdUser() && $i < count($this->utilisateurs)-1){
            $i++;
        }
        if ($unIdUtilisateur == $this->utilisateurs[$i]->getIdUser()){
            return $this->utilisateurs[$i];
        }
    }



}