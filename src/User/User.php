<?php
namespace User;

class User
{
    public $pseudo;

    public $mail;

    public $mdp;

    public $avatar;

    public $date_naissance;

    public $nom;

    public $prenom;

    public $rang;

    public function getRang()
    {
        return $this->rang;
    }


    public function setRang($rang)
    {
        $this->rang = $rang;
        return $this;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getNom()
    {
        return $this->nom;
    }


    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    public function getDate_naissance()
    {
        return $this->date_naissance;
    }


    public function setDate_naissance($date_naissance)
    {
        $this->date_naissance = $date_naissance;
        return $this;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }


    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }

    public function getMDP()
    {
        return $this->mdp;
    }


    public function setMDP($mdp)
    {
        $this->mdp = $mdp;
        return $this;
    }

    public function getMail()
    {
        return $this->mail;
    }

     public function setMail($mail)
    {
        $this->mail = $mail;
        return $this;
    }


    public function getPseudo()
    {
        return $this->pseudo;
    }


    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
        return $this;
    }


}

