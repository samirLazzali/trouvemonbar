<?php
namespace User;

class User
{
    /**
     * @var int
     */
    private $id;

    private $nick;

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

    public function getNick()
    {
    }

    public function setNick($nick)
    {
        $this->$nick = $nick;
        return $this;
    }

}

