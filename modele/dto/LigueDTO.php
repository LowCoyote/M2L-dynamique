<?php


class LigueDTO
{
    private $idLigue;
    private $nomLigue;
    private $site;
    private $descriptif;

    /**
     * LigueDTO constructor.
     * @param $idLigue
     * @param $nomLigue
     * @param $site
     * @param $descriptif
     */
    public function __construct($idLigue, $nomLigue, $site, $descriptif)
    {
        $this->idLigue = $idLigue;
        $this->nomLigue = $nomLigue;
        $this->site = $site;
        $this->descriptif = $descriptif;
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
    public function getNomLigue()
    {
        return $this->nomLigue;
    }

    /**
     * @param mixed $nomLigue
     */
    public function setNomLigue($nomLigue)
    {
        $this->nomLigue = $nomLigue;
    }

    /**
     * @return mixed
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @param mixed $site
     */
    public function setSite($site)
    {
        $this->site = $site;
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
}