<?php

class DataUser {
	protected $_bdd;

	public function __construct($bdd) {
		$this->_bdd = $bdd;
	}

	public static function countUser($bdd) {return $bdd->query('SELECT COUNT(*) FROM utilisateur');}

	public static function getAll($bdd) {return $bdd->query('SELECT * FROM utilisateur ORDER BY id DESC');}

	public function getAllById($id) {
		$all = $this->_bdd->prepare('SELECT * FROM utilisateur WHERE id = :id');
		$all->execute(array("id" => $id));

		return $all;
	}

	public function connectAll($mail, $password) {
		$all = $this->_bdd->prepare('SELECT * FROM utilisateur WHERE mail = :mail AND mdp = :password');
		$all->execute(array(
			"mail" => $mail,
			"password" => $password
		));

		return $all;
	}

	public function getIdByMail($mail) {
		$id = $this->_bdd->prepare('SELECT id FROM utilisateur WHERE mail = :mail');
		$id->execute(array("mail" => $mail));

		return $id;
	}

	public function getPassById($id) {
		$pass = $this->_bdd->prepare('SELECT mdp FROM utilisateur WHERE id = :id');
		$pass->execute(array("id" => $id));

		return $pass;
	}

	public function getStatutById($id) {
		$statut = $this->_bdd->prepare('SELECT statut FROM utilisateur WHERE id = :id');
		$statut->execute(array("id" => $id));

		return $statut;
	}

	public function validation($mail, $code) {
		$valid = $this->_bdd->prepare('UPDATE utilisateur SET code_validation = NULL, statut = \'utilisateur\' WHERE mail = :mail AND code_validation = :code AND statut = \'valid_mail\'');
		$valid->execute(array(
			"mail" => $mail,
			"code" => $code
		));

		return $valid;
	}

	public function newUser($mail, $password, $code) {
		$new_user = $this->_bdd->prepare('INSERT INTO utilisateur(mail, statut, code_validation, mdp, date_dernier_co, date_inscription) VALUES(:mail, \'valid_mail\', :code, :password, NOW(), NOW())');
		$new_user->execute(array(
			"mail" => $mail,
			"code" => $code,
			"password" => $password
		));

		return $new_user;
	}

	public function updateDernierCo($id) {
		$date = $this->_bdd->prepare('UPDATE utilisateur SET date_dernier_co = NOW() WHERE id = :id');
		$date->execute(array("id" => $id));

		return $date;
	}

	public function updatePass($id, $pass, $new_pass) {
		$date = $this->_bdd->prepare('UPDATE utilisateur SET mdp = :new_pass WHERE id = :id AND mdp = :pass');
		$date->execute(array(
			"id" => $id,
			"pass" => $pass,
			"new_pass" => $new_pass
		));

		return $date;
	}

	public function updateStatut($id, $statut) {
		$update = $this->_bdd->prepare('UPDATE utilisateur SET statut = :statut WHERE id = :id');
		$update->execute(array(
			"id" => $id,
			"statut" => $statut
		));

		return $update;
	}

	public function deleteUser($id) {
		$delete = $this->_bdd->prepare('DELETE FROM utilisateur WHERE id = :id');
		$delete->execute(array("id" => $id));

		return $delete;
	}

}
