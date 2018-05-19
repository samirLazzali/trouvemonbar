<?php 

/**
*
*/
class User
{
	public $id;
	public $firstname;
	public $lastname;
	public $birthday;
	public $nickname;
	public $domicile;
	public $id_groupe;
	public $mdp;
	
	function __construct($donnees = null)
	{
		if ($donnees) {
		foreach ($donnees as $attribut => $valeur) {
			$this->$attribut = $valeur;
		}
	}
	}
}
