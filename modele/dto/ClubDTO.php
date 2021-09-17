<?php


class ClubDTO
{
    private $idClub;
    private $nomClub;
    private $adresseClub;
    private $idLigue;
    private $idCommune;

    /**
     * ClubDTO constructor.
     * @param $idClub
     * @param $nomClub
     * @param $adresseClub
     * @param $idLigue
     * @param $idCommune
     */
    public function __construct($idClub, $nomClub, $adresseClub, $idLigue, $idCommune)
    {
        $this->idClub = $idClub;
        $this->nomClub = $nomClub;
        $this->adresseClub = $adresseClub;
        $this->idLigue = $idLigue;
        $this->idCommune = $idCommune;
    }

    /**
     * @return mixed
     */
    public function getIdClub()
    {
        return $this->idClub;
    }

    /**
     * @param mixed $idClub
     */
    public function setIdClub($idClub)
    {
        $this->idClub = $idClub;
    }

    /**
     * @return mixed
     */
    public function getNomClub()
    {
        return $this->nomClub;
    }

    /**
     * @param mixed $nomClub
     */
    public function setNomClub($nomClub)
    {
        $this->nomClub = $nomClub;
    }

    /**
     * @return mixed
     */
    public function getAdresseClub()
    {
        return $this->adresseClub;
    }

    /**
     * @param mixed $adresseClub
     */
    public function setAdresseClub($adresseClub)
    {
        $this->adresseClub = $adresseClub;
    }

    /**
     * @return mixed
     */
    public function getIdLigue()
    {
        return $this->idLigue;
    }

    /**
     * @param mixed $idLigue
     */
    public function setIdLigue($idLigue)
    {
        $this->idLigue = $idLigue;
    }

    /**
     * @return mixed
     */
    public function getIdCommune()
    {
        return $this->idCommune;
    }

    /**
     * @param mixed $idCommune
     */
    public function setIdCommune($idCommune)
    {
        $this->idCommune = $idCommune;
    }
}