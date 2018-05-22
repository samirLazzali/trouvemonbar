<?php

class ProfilUser {
	protected $_bdd;
	protected $_id;

	public function __construct($bdd, $id) {
		$this->_bdd = $bdd;
		$this->_id = $id;
	}

	public static function newUser($bdd, $id_utilisateur, $id_sexe, $search_sexe, $date_naissance) {
		$new_user = $bdd->prepare('INSERT INTO profil(id_utilisateur, id_sexe, search_sexe, date_naissance) VALUES(:id_utilisateur, :id_sexe, :search_sexe, :date_naissance)');
		$new_user->execute(array(
			"id_utilisateur" => $id_utilisateur,
			"id_sexe" => $id_sexe,
			"search_sexe" => $search_sexe,
			"date_naissance" => $date_naissance,
		));

		return $new_user;
	}

	public function getAll() {
		$all = $this->_bdd->prepare('SELECT * FROM profil WHERE id_utilisateur = :id');
		$all->execute(array("id" => $this->_id));

		return $all;
	}

	public function getSexeSearch() {
		$s = $this->_bdd->prepare('SELECT search_sexe FROM profil WHERE id_utilisateur = :id');
		$s->execute(array("id" => $this->_id));

		return $s;
	}

	public function setSexeSearch($search_sexe) {
		$s = $this->_bdd->prepare('UPDATE profil SET search_sexe = :search_sexe WHERE id_utilisateur = :id');
		$s->execute(array(
			"search_sexe" => $search_sexe,
			"id" => $this->_id
		));

		return $s;
	}

	public function getIdSexe() {
		$s = $this->_bdd->prepare('SELECT id_sexe FROM profil WHERE id_utilisateur = :id');
		$s->execute(array("id" => $this->_id));

		return $s;
	}
	public function getTags() {
		$tags = $this->_bdd->prepare('SELECT tags FROM profil WHERE id_utilisateur = :id');
		$tags->execute(array("id" => $this->_id));

		return $tags;
	}

	public function setTags($tags) {
		$t = $this->_bdd->prepare('UPDATE profil SET tags = :tags WHERE id_utilisateur = :id');
		$t->execute(array(
			"tags" => $tags,
			"id" => $this->_id
		));

		return $t;
	}

	public function deleteUser() {
		$delete = $this->_bdd->prepare('DELETE FROM profil WHERE id_utilisateur = :id');
		$delete->execute(array("id" => $this->_id));

		return $delete;
	}
}
