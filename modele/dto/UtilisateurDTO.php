<?php


class UtilisateurDTO
{
    use Hydrate;
    //
    private $idUser;
    private $nom;
    private $prenom;
    private $login;
    private $statut;
    private $typeUser;
    private $idFonct;
    private $idLigue;
    private $idClub;

    /**
     * UtilisateurDTO constructor.
     * @param $idUser
     * @param $nom
     * @param $prenom
     * @param $login
     * @param $mdp
     * @param $statut
     * @param $typeUser
     * @param $idFonct
     * @param $idLigue
     * @param $idClub
     */

    public function __construct()
    {
        
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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @param mixed $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    /**
     * @return mixed
     */
    public function getTypeUser()
    {
        return $this->typeUser;
    }

    /**
     * @param mixed $typeUser
     */
    public function setTypeUser($typeUser)
    {
        $this->typeUser = $typeUser;
    }

    /**
     * @return mixed
     */
    public function getIdFonct()
    {
        return $this->idFonct;
    }

    /**
     * @param mixed $idFonct
     */
    public function setIdFonct($idFonct)
    {
        $this->idFonct = $idFonct;
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

}