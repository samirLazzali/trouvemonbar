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
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var \DateTimeInterface
     */
    private $birthday;

    /**
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

   /**
     * @param string $nickname
     * @return User
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomicile()
    {
        return $this->domicile;
    }

   /**
     * @param string $domicile
     * @return User
     */
    public function setDomicile($domicile)
    {
        $this->domicile = $domicile;
        return $this;
    }

    /**
     * @return string
     */
    public function getMdp()
    {
        return $this->mdp;
    }

   /**
     * @param string $mdp
     * @return User
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
        return $this;
    }

    /**
     * @return int
     */
    public function getId_groupe()
    {
        return $this->id_groupe;
    }

    /**
     * @param int $id_groupe
     * @return User
     */
    public function setId_groupe($id)
    {
        $this->id_groupe = $id_groupe;
        return $this;
    }


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
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getBirthday(): \DateTimeInterface
    {
        return $this->birthday;
    }

    /**
     * @param \DateTimeInterface $birthday
     * @return User
     */
    public function setBirthday(\DateTimeInterface $birthday)
    {
        $this->birthday = $birthday;
        return $this;
    }


    /**
     * @return int
     * @throws \OutOfRangeException
     */
    public function getAge(): int
    {
        $now = new \DateTime();

        if ($now < $this->getBirthday()) {
            throw new \OutOfRangeException('Birthday in the future');
        }

        return $now->diff($this->getBirthday())->y;
    }
}

