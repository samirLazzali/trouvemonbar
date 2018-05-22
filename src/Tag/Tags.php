<?php
namespace Tag;

class Tag
{
    public $id_tags;

    public $nom;



    public function getNom()
    {
        return $this->nom;
    }


    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

	public function setIdTags($id_tags)
	{
		$this->id_tags=$id_tags;
		return $this;
	}
	public function getIdTags()
	{
		return $this->id_tags;
	}

}
