<?php

class Chat {
    protected $_bdd;
    protected $_id_utilisateur;
    protected $_id_cible;

    public function __construct($bdd, $id_utilisateur, $id_cible) {
      $this->_bdd = $bdd;
      $this->_id_utilisateur = $id_utilisateur;
      $this->_id_cible = $id_cible;
    }

    public static function countMessageNonLu($bdd, $id) {
      $select = $bdd->prepare('SELECT COUNT(*) as count FROM chat
        WHERE id_cible = :id
        AND etat_lu = 0
      ');
      $select->execute(array("id" => $id));

      return $select;
    }

    public static function getListChat($bdd, $id) {
      $list = $bdd->prepare('SELECT * FROM chat
        WHERE id IN (SELECT MAX(id) FROM chat WHERE id_utilisateur = :id OR id_cible = :id GROUP BY id_chat)
        ORDER BY id DESC');
      $list->execute(array("id" => $id));

      return $list;
    }

    public function getMessages($min, $max) {
      $messages = $this->_bdd->prepare('SELECT *
        FROM chat c

        WHERE (id_utilisateur = :id_utilisateur
        AND id_cible = :id_cible)
        OR (id_utilisateur = :id_cible
        AND id_cible = :id_utilisateur)

        ORDER BY id DESC
        LIMIT :max OFFSET :min');
      $messages->bindParam(':id_utilisateur', $this->_id_utilisateur, PDO::PARAM_INT);
      $messages->bindParam(':id_cible', $this->_id_cible, PDO::PARAM_INT);
      $messages->bindParam(':min', $min, PDO::PARAM_INT);
      $messages->bindParam(':max', $max, PDO::PARAM_INT);

      $messages->execute();

    return $messages;
    }

    public function sendMessage($message) {
      $insert = $this->_bdd->prepare('INSERT INTO chat(id_chat, id_cible, id_utilisateur, message, etat_lu, date_message)
       VALUES(:id_chat, :id_cible, :id_utilisateur, :message, 0, NOW())');
      $insert->execute(array(
        "id_chat" => ($this->_id_cible > $this->_id_utilisateur) ? $this->_id_utilisateur.$this->_id_cible : $this->_id_cible.$this->_id_utilisateur,
        "id_cible" => $this->_id_cible,
        "id_utilisateur" => $this->_id_utilisateur,
        "message" => $message
      ));

      return $insert;
    }

    public function getMessageLeft($id) {
      $select = $this->_bdd->prepare('SELECT *
        FROM chat
        WHERE ((id_utilisateur = :id_utilisateur
        AND id_cible = :id_cible)
        OR (id_utilisateur = :id_cible
        AND id_cible = :id_utilisateur))
        AND id > :id
        ORDER BY id DESC
        ');
      $select->execute(array(
          "id" => $id,
          "id_cible" => $this->_id_cible,
          "id_utilisateur" => $this->_id_utilisateur
      ));

      return $select;
    }


    public function resetMessageNonLu() {
      $update = $this->_bdd->prepare('UPDATE chat SET etat_lu = 1
        WHERE id_utilisateur = :id_cible
        AND id_cible = :id_utilisateur');
      $update->execute(array(
        "id_cible" => $this->_id_cible,
        "id_utilisateur" => $this->_id_utilisateur
      ));

      return $update;
    }

}
