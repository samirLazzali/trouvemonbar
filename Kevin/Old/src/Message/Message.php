<?php
/**
 * Created by PhpStorm.
 * User: KevinXu
 * Date: 16/04/2018
 * Time: 17:30
 */
namespace Message;

class Message
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $emetteur;

    /**
     * @var string
     */
    private $recepteur;

    /**
     * @var \DateTimeInterface
     */
    private $date;

    /**
     * @var string
     */
    private $contenu;


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
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getEmetteur()
    {
        return $this->emetteur;
    }

    /**
     * @param string $emetteur
     */
    public function setEmetteur($emetteur)
    {
        $this->emetteur = $emetteur;
    }

    /**
     * @return string
     */
    public function getRecepteur()
    {
        return $this->recepteur;
    }

    /**
     * @param string $recepteur
     */
    public function setRecepteur($recepteur)
    {
        $this->recepteur = $recepteur;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTimeInterface $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param string $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }
}

