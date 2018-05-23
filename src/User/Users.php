<?php
namespace User;

class Users
{

    /**
     * @var string
     */
    private $pseudo;

    /**
     * @var string
     */
    private $mdp;

    /**
     * @var \DateTimeInterface
     */
    private $birthday;

    /**
     * @var boolean
     */
    private $admin;
    
    /**
     * @return int
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param int $pseudo
     * @return Users
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
        return $this;
    }

    public function getMdp()
    {
        return $this->mdp;
    }

    public function setMdp($mdp)
    {
        $this->mdp=$mdp;
        return $this;
    }

    /**
     * @return string
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param string $admin
     * @return User
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
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
