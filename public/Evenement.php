<?php

/**
* 
*/
class Evenement
{
	public $id;
	public $organisateur;
	public $nom;
	public $description;
	public $lieu;
	public $date;
	public $date_creation;
	public $date_modif;
	public $before;
	public $prix;
	public $musique;
	public $categorie;
	public $table_participants;
	
	function __construct($donnees = null)
	{
		if ($donnees) {
		foreach ($donnees as $attribut => $valeur) {
			$this->$attribut = $valeur;
		}
	}
	}
}