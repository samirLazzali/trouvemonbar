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
		if ($query){
		while ($participant = $query->fetch()) {
			$resultat[] = $userManager->getId($participant['id']);
		}
	}
		return $resultat;
	}

	function add($user, $nom_table) {
		$resultat = $this->db->query("INSERT INTO $nom_table (id) VALUES ($user)");
		if ($resultat){
			echo '<div class="container alert alert-success">
					  <strong>Success!</strong> Participation confirmée
					</div>';

		}
	}

	function remove($id, $nom_table) {
		$this->db->query("DELETE FROM $nom_table WHERE id = $id");
	}
}