<?php

class Questionnaire {
	protected $_bdd;
	protected $_id;

	public function __construct($bdd, $id) {
		$this->_bdd = $bdd;
		$this->_id = $id;
	}

	public static function getAllQuestions($bdd) {
		return $bdd->query('SELECT * FROM qadmin');
	}

	public function deleteQuestion($id) {
		$supp = $this->_bdd->prepare('DELETE FROM qadmin WHERE id = :id');
		$supp->execute(array(
			"id" => $id
		));

		return $supp;
}

	public function newQuestion($question, $reponses) {
		$new_quest = $this->_bdd->prepare('INSERT INTO qadmin(id_admin, question, reponses, date_q) VALUES(:id_admin, :question, :reponses, NOW())');
		$new_quest->execute(array(
			"id_admin" => $this->_id,
			"question" => $question,
			"reponses" => $reponses,
		));

		return $new_quest;
	}

}
