<?php
namespace Comment;

class Comment
{
    private $id;
    private $idBar;
    private $idUser;
    private $content;
    private $dateCom;

    public function getId()
    {
        return $this->id;
    }

    public function getIdBar()
    {
        return $this->idBar;
    }

    public function getIdUser()
    {
        return $this->idUser;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    public function setIdBar(int $idBar)
    {
        $this->idBar = $idBar;
        return $this;
    }

    public function setIdUser(int $idUser)
    {
        $this->idUser = $idUser;
        return $this;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
        return $this;
    }

    public function setDate(string $dateCom)
    {
        $this->dateCom = $dateCom;
        return $this;
    }
}
