<?php
namespace Amis;

class Amis
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $personne1;

    /**
     * @var string
     */
    private $personne2;


    //Liste des setters et getters

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Amis
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getPersonne1()
    {
        return $this->personne1;

    }

    /**
     * @param string $personne1
     * @return Amis
     */
    public function setPersonne1($personne1)
    {
        $this->personne1 = $personne1;
        return $this;
    }

    /**
     * @return string
     */
    public function getPersonne2()
    {
        return $this->personne2;
       
    }

    /**
     * @param string $personne2
     * @return Amis
     */
    public function setPersonne2($personne2)
    {
        $this->personne2 = $personne2;
         return $this;
    }

}

