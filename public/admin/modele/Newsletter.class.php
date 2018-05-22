<?php
class Newsletter {
  protected $_bdd;
  protected $_id;

  public function __construct($bdd, $id) {
    $this->_bdd = $bdd;
    $this->_id = $id;
  }

  public static function getAllNewsletter($bdd) {
    return $bdd->query('SELECT * FROM newsletter ORDER BY id DESC');
  }

  public static function getPagerNewsletter($bdd, $min, $max) {
    $select = $bdd->prepare('SELECT * FROM newsletter ORDER BY id DESC LIMIT :max OFFSET :min');
    $select->bindParam(':min', $min, PDO::PARAM_INT);
    $select->bindParam(':max', $max, PDO::PARAM_INT);

    $select->execute();

    return $select;
  }

  public static function getDernierNewsletter($bdd) {
    return $bdd->query('SELECT * FROM newsletter ORDER BY id DESC LIMIT 1');
  }

  public static function getNewsletter($bdd, $id) {
    $select = $bdd->prepare('SELECT * FROM newsletter WHERE id = :id');
    $select->execute(array("id" => $id));

    return $select;
}

  public function newNewsletter($sujet, $message) {
    $nouveau = $this->_bdd->prepare('INSERT INTO newsletter(id_admin, sujet, message, date_news) VALUES(:id, :sujet, :message, NOW())');
    $nouveau->execute(array(
      "id" => $this->_id,
      "sujet" => $sujet,
      "message" => $message
    ));

    return $nouveau;
  }

  public function updateNewsletter($id, $sujet, $message) {
    $update = $this->_bdd->prepare('UPDATE newsletter SET sujet = :sujet, message = :message WHERE id = :id');
    $update->execute(array(
      "sujet" => $sujet,
      "message" => $message,
      "id" => $id
    ));

    return $update;
  }

  public function deleteNewsletter($id) {
    $delete = $this->_bdd->prepare('DELETE FROM newsletter WHERE id = :id');
    $delete->execute(array("id" => $id));

    return $delete;
  }



}
