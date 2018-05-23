<?php
/**
 * Created by PhpStorm.
 * User: clement
 * Date: 05/05/18
 * Time: 16:54
 */

namespace User;


class Chapitre
{
    /**
     * @var string
     */
    private $nom;

    /**
     * @var int
     */
    private $num;

    /**
     * @var int
     */
    private $nb_pages;

    /**
     * @var string
     */
    private $nom_manga;


    private $date_pub;

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return int
     */
    public function getNum(): int
    {
        return $this->num;
    }

    /**
     * @param int $num
     */
    public function setNum(int $num): void
    {
        $this->num = $num;
    }

    /**
     * @return int
     */
    public function getNbPages(): int
    {
        return $this->nb_pages;
    }

    /**
     * @param int $nb_pages
     */
    public function setNbPages(int $nb_pages): void
    {
        $this->nb_pages = $nb_pages;
    }

    /**
     * @return string
     */
    public function getNomManga(): string
    {
        return $this->nom_manga;
    }

    /**
     * @param string $nom_manga
     */
    public function setNomManga(string $nom_manga): void
    {
        $this->nom_manga = $nom_manga;
    }

    /**
     * @return mixed
     */
    public function getDatePub()
    {
        return $this->date_pub;
    }

    /**
     * @param mixed $date_pub
     */
    public function setDatePub($date_pub)
    {
        $this->date_pub = $date_pub;
    }

    /*********** Getters and setters ************/

}