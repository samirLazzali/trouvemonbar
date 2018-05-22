<?php

class Niveau {
  protected $_bdd;
  protected $_id;

  public function __construct($bdd, $id) {
    $this->_bdd = $bdd;
    $this->_id = $id;
  }

  public static function getNiveauCurrent($bdd, $genre, $pallier) {
    $niveau = $bdd->prepare('SELECT nom, pallier FROM sex_appeal WHERE :pallier <= pallier AND genre = :genre ORDER BY pallier');
    $niveau->execute(array(
      "genre" => $genre,
      "pallier" => $pallier
    ));

    return $niveau;
  }

  public function newNiveau($nom, $pallier, $genre) {
    $insert = $this->_bdd->prepare('INSERT INTO sex_appeal(id_admin, nom, pallier, genre, date_update) VALUES(:id_admin, :nom, :pallier, :genre, NOW())');
    $insert->execute(array(
      "id_admin" => $this->_id,
      "nom" => $nom,
      "pallier" => $pallier,
      "genre" => $genre
    ));

    return $insert;
  }

  public function getNiveaux() {
    $get = $this->_bdd->query('SELECT * FROM sex_appeal ORDER BY pallier, genre');

    return $get;
  }

  public function deleteNiveau($id) {
    $delete = $this->_bdd->prepare('DELETE FROM sex_appeal WHERE id = :id');
    $delete->execute(array("id" => $id));

    return $delete;
  }

}




?>
