<?php

namespace TagContenuMedia;


class TagContenuMedia
{

    public $id_media;
    public $titre;
    public $auteur;
    public $tag;
    public $image;
    public $type;
    public $valide;



    public function getIdMedia()
    {
        return $this->id_media;
    }
    public function setIdMedia($id_media)
    {
        $this->id_media=$id_media;
        return $this;
    }
    public function getTitre()
    {
        return $this->titre;
    }
    public function setTitre($titre)
    {
        $this->titre=$titre;
        return $this;
    }
    public function getAuteur()
    {
        return $this->auteur;
    }
    public function setAuteur($auteur)
    {
        $this->auteur=$auteur;
        return $this;
    }

    public function getTag()
    {
        return $this->tag;
    }


    public function setTag($tag)
    {
        $this->tag= $tag;
        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }
    public function setType($type)
    {
        $this->type=$type;
        return $this;
    }
    public function getValide()
    {
        return $this->valide;
    }
    public function setValide($valide)
    {
        $this->valide=$valide;
        return $this;
    }
}

