<?php

class ParticipantsManager
{
	private $db;
	function __construct($db)
	{
		$this->db = $db;
	}

	function getAll($nom_table) {
		$query = $this->db->query('SELECT * FROM ' . $nom_table);
		$resultat = [];
		$userManager = new UserManager($this->db);
		while ($participant = $query->fetch()) {
			$resultat[] = $userManager->getId($participant['id']);
		}
		return $resultat;
	}

	function add($user, $nom_table) {
		$resultat = $this->db->query("INSERT INTO $nom_table (id) VALUES ($user)");
		if ($resultat){
			echo "ParticipantsManager: Participant ajouté ! <br>";
		}
		else {
			echo "ParticipantsManager: Problème lors de l'ajout du participant <br>";
		}
	}

	function remove($id, $nom_table) {
		$this->_db->exec("DELETE FROM $nom_table WHERE id = $id");
	}
}