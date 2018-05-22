<?php

class Rquestionnaire {
	protected $_bdd;
	protected $_id;

	public function __construct($bdd, $id) {
		$this->_bdd = $bdd;
		$this->_id = $id;
	}

	public static function deleteReponseById($bdd, $question_id) {
		$delete = $bdd->prepare('DELETE FROM qutilisateur WHERE question = :question');
		$delete->execute(array("question" => $question_id));

		return $delete;
	}

	public function insertReponse($mail, $question_id, $reponse) {
		$insert = $this->_bdd->prepare('INSERT INTO qutilisateur(id_utilisateur, mail, question, reponse, date_q) VALUES(:id_utilisateur, :mail, :question, :reponse, NOW())');
		$insert->execute(array(
			"id_utilisateur" => $this->_id,
			"mail" => $mail,
			"question" => $question_id,
			"reponse" => $reponse
		));

		return $insert;
	}
	public function deleteAllReponse() {
		$delete = $this->_bdd->prepare('DELETE FROM qutilisateur WHERE id_utilisateur = :id_utilisateur');
		$delete->execute(array("id_utilisateur" => $this->_id));

		return $delete;
	}

}
