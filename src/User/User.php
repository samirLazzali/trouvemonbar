<?php
namespace User;

class User
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $prenom;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $surnom;

    /**
     * @var string
     */
    private $password;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getprenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $firstname
     * @return User
     */
    public function setprenom($firstname)
    {
        $this->prenom = $firstname;
        return $this;
    }

    /**
     * @return string
     */
    public function getnom()
    {
        return $this->nom;
    }

    /**
     * @param string $lastname
     * @return User
     */
    public function setnom($lastname)
    {
        $this->nom = $lastname;
        return $this;
    }

    /**
     * @return string
     */
    public function getsurnom()
    {
        return $this->surnom;
    }

    /**
     * @param string $surnom
     * @return User
     */
    public function setsurnom(string $surnom)
    {
        $this->surnom = $surnom;
        return $this;
    }
}