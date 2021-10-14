<?php


class EffectueDTO
{
    use Hydrate;

    private $idForma;
    private $idUser;
    private $EtatInscription;
    private $DateInscription;

    /**
     * @param $idForma
     * @param $idUser
     * @param $EtatInscription
     * @param $DateInscription
     */
    public function __construct($idForma = null, $idUser = null, $EtatInscription = null, $DateInscription = null)
    {
        $this->idForma = $idForma;
        $this->idUser = $idUser;
        $this->EtatInscription = $EtatInscription;
        $this->DateInscription = $DateInscription;
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
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    /**
     * @return mixed
     */
    public function getEtatInscription()
    {
        return $this->EtatInscription;
    }

    /**
     * @param mixed $EtatInscription
     */
    public function setEtatInscription($EtatInscription)
    {
        $this->EtatInscription = $EtatInscription;
    }

    /**
     * @return mixed
     */
    public function getDateInscription()
    {
        return $this->DateInscription;
    }

    /**
     * @param mixed $DateInscription
     */
    public function setDateInscription($DateInscription)
    {
        $this->DateInscription = $DateInscription;
    }
}

