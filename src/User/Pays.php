<?php
namespace User;

class Pays
{
    /**
     * @var int
     */
    private $id_p;

    /**
     * @var string
     */
    private $nom_p;

    /**
     * @var string
     */
    private $code_p;

    /**
     * @var string
     */
    private $devise;
    
    /**
     * @var string
     */
    private $langue;

    /**
     * @var string
     */
    private $capitale;

    /**
     * @var string
     */
    private $continent;


    /**
     * @var string
     */
    private $lienwiki_p;


    /**
     * @return int
     */
    public function getId_p()
    {
        return $this->id_p;
    }

    /**
     * @param int $
     * @return User
     */
    public function setId_p($id_p)
    {
        $this->id_p = $id_p;
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
        $this->nom_p = $nom_p;
        return $this;
    }

    public function getCode_p()
    {
        return $this->code_p;
    }

    /**
     * @param string $nom
     * @return User
     */
    public function setCode_p($code_p)
    {
        $this->code_p = $code_p;
        return $this;
    }

    /**
     * @return string
     */
    public function getDevise()
    {
        return $this->devise;
    }

    public function setDevise($devise)
    {
        $this->devise = $devise;
        return $this;
    }

    public function getLangue()
    {
        return $this->langue;
    }

    /**
     * @param string $lastname
     * @return User
     */
    public function setLangue($langue)
    {
        $this->langue = $langue;
        return $this;
    }

    /**
     * @return \string
     */
    public function getCapitale()
    {
        return $this->capitale;
    }

    public function setCapitale($capitale)
    {
        $this->capitale = $capitale;
        return $this;
    }

    public function getContinent()
    {
        return $this->continent;
    }

    /**
     * @param \DateTimeInterface $birthday
     * @return User
     */
    public function setContinent($continent)
    {
        $this->continent = $continent;
        return $this;
    }


    public function getLienwiki_p()
    {
        return $this->lienwiki_p;
    }

    public function setLienwiki_p($lienwiki_p)
    {
        $this->lienwiki_p = $lienwiki_p;
        return $this;
    }
    


}

