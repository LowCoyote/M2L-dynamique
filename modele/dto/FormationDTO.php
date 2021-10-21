<?php


class FormationDTO
{
    use Hydrate;

    private $idForma;
    private $intitule;
    private $descriptif;
    private $duree;
    private $dateOuvertureInscription;
    private $dateClotureInscription;
    private $dateDebut;
    private $dateFin;
    private $effectifMax;

    /**
     * @param $idForma
     * @param $intitule
     * @param $descriptif
     * @param $duree
     * @param $dateOuvertureInscription
     * @param $dateClotureInscription
     * @param $dateDebut
     * @param $dateFin
     * @param $effectifMax
     */
    public function __construct($idForma = null, $intitule = null, $descriptif = null, $duree = null, $dateOuvertureInscription = null, $dateClotureInscription = null, $dateDebut = null, $dateFin = null, $effectifMax = null)
    {
        $this->idForma = $idForma;
        $this->intitule = $intitule;
        $this->descriptif = $descriptif;
        $this->duree = $duree;
        $this->dateOuvertureInscription = $dateOuvertureInscription;
        $this->dateClotureInscription = $dateClotureInscription;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->effectifMax = $effectifMax;
    }

    /**
     * @return mixed
     */
    public function getIdForma()
    {
        return $this->idForma;
    }

    /**
     * @param mixed $idForma
     */
    public function setIdForma($idForma)
    {
        $this->idForma = $idForma;
    }

    /**
     * @return mixed
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * @param mixed $intitule
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;
    }

    /**
     * @return mixed
     */
    public function getDescriptif()
    {
        return $this->descriptif;
    }

    /**
     * @param mixed $descriptif
     */
    public function setDescriptif($descriptif)
    {
        $this->descriptif = $descriptif;
    }

    /**
     * @return mixed
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * @param mixed $duree
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;
    }

    /**
     * @return mixed
     */
    public function getDateOuvertureInscription()
    {
        return $this->dateOuvertureInscription;
    }

    /**
     * @param mixed $dateOuvertureInscription
     */
    public function setDateOuvertureInscription($dateOuvertureInscription)
    {
        $this->dateOuvertureInscription = $dateOuvertureInscription;
    }

    /**
     * @return mixed
     */
    public function getDateClotureInscription()
    {
        return $this->dateClotureInscription;
    }

    /**
     * @param mixed $dateClotureInscription
     */
    public function setDateClotureInscription($dateClotureInscription)
    {
        $this->dateClotureInscription = $dateClotureInscription;
    }

    /**
     * @return mixed
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * @param mixed $dateDebut
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return mixed
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * @param mixed $dateFin
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }

    /**
     * @return mixed
     */
    public function getEffectifMax()
    {
        return $this->effectifMax;
    }

    /**
     * @param mixed $effectifMax
     */
    public function setEffectifMax($effectifMax)
    {
        $this->effectifMax = $effectifMax;
    }

}