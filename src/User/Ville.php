<?php
namespace User;

class Ville
{
    /**
     * @var int
     */
    private $id_v;

    /**
     * @var string
     */
    private $nom_v;

    /**
     * @var string
     */
    private $nom_p;

    /**
     * @var string
     */
    private $population;
    
    /**
     * @var string
     */
    private $superficie;

 
    /**
     * @var string
     */
    private $lienwiki_v;


    /**
     * @return int
     */
    public function getId_v()
    {
        return $this->id_v;
    }

    /**
     * @param int $
     * @return User
     */
    public function setId_v($id_v)
    {
        $this->id_v = $id_v;
        return $this;
    }

    /**
     * @return string
     */
    public function getNom_v()
    {
        return $this->nom_v;
    }

    public function setNom_v($nom_v)
    {
        $this->nom_v = $nom_v;
        return $this;
    }

    /**
     * @return string
     */
    public function getNom_p()
    {
        return $this->nom_p;
    }

    public function setNom_p($nom_p)
    {
        $this->nom_p= $nom_p;
        return $this;
    }

    public function getPopulation()
    {
        return $this->population;
    }

    /**
     * @param string $nom
     * @return User
     */
    public function setPopulation($population)
    {
        $this->population = $population;
        return $this;
    }

    /**
     * @return string
     */
    public function getSuperficie()
    {
        return $this->superficie;
    }

    public function setSuperficie($superficie)
    {
        $this->superficie = $superficie;
        return $this;
    }

   

    public function getLienwiki_v()
    {
        return $this->lienwiki_v;
    }

    public function setLienwiki_v($lienwiki_v)
    {
        $this->lienwiki_v = $lienwiki_v;
        return $this;
    }
    


}
