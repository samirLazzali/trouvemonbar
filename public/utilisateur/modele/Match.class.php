<?php

class Match {
  protected $_bdd;
  protected $_id;

  public function __construct($bdd, $id) {
    $this->_bdd = $bdd;
    $this->_id = $id;
  }

  /*
  * @brief Sélectionne un utilisateur au hasard qui n'a pas encore été matché par
  * l'utilisateur actuel et qui est du genre $search_sexe ou $search_sexe2 avec un statut différent de $statut
  */

    public static function matchEntreEux($bdd, $id_user, $id_cible, $statut) {
      $check = $bdd->prepare('SELECT s.id
        FROM suggestion s
        INNER JOIN suggestion s2
        ON s.id_cible = s2.id_utilisateur

        INNER JOIN utilisateur u
        ON u.id = s.id_cible

        WHERE s.id_utilisateur = :id
        AND s.id_cible = :id_cible
        AND s.resultat = 1

        AND s2.id_cible = :id
        AND s2.id_utilisateur = :id_cible
        AND s2.resultat = 1

        AND u.statut <> :statut');

        $check->execute(array(
          "id_cible" => $id_cible,
          "id" => $id_user,
          "statut" => $statut
        ));

      return $check;
    }

  public function getNewMatch($statut, $search_sexe, $search_sexe2) {
    $new_match = $this->_bdd->prepare('  SELECT p.id_utilisateur, p.id_sexe, p.tags FROM profil p

	  LEFT JOIN suggestion s
    ON p.id_utilisateur = s.id_cible
    AND s.id_utilisateur = :id

    INNER JOIN utilisateur u
    ON u.id = p.id_utilisateur

    WHERE s.id_cible IS NULL
    AND p.id_utilisateur <> :id
    AND (id_sexe = :search_sexe OR id_sexe = :search_sexe2)
    AND u.statut <> :statut

    ORDER BY RANDOM()/*RAND pour MySql*/
    LIMIT 1

      ');
    $new_match->execute(array(
      "id" => $this->_id,
      "statut" => $statut,
      "search_sexe" => $search_sexe,
      "search_sexe2" => $search_sexe2
    ));

    return $new_match;
  }

  /**
  * @brief Récupère tous les match de $this->_id qui ne possédent pas le statut $statut avec leur profil
  */
  public function getMatch($statut) {
    $get_match = $this->_bdd->prepare('SELECT s.id_cible, s.etat_lu, p.id_sexe, p.tags, EXTRACT(EPOCH FROM (NOW() - u.date_dernier_co)) as connect
      FROM suggestion s

      INNER JOIN suggestion s2
      ON s.id_cible = s2.id_utilisateur

      INNER JOIN utilisateur u
      ON u.id = s.id_cible

      INNER JOIN profil p
      ON p.id_utilisateur = s.id_cible

      WHERE s.id_utilisateur = :id
      AND s.resultat = 1

      AND s2.id_cible = :id
      AND s2.resultat = 1

      AND u.statut <> :statut

      ORDER BY s.etat_lu, s.id_cible
    ');
    $get_match->execute(array(
      "id" => $this->_id,
      "statut" => $statut
    ));

    return $get_match;
  }

  public function updateResultatMatch($id_cible, $resultat) {
    $update = $this->_bdd->prepare('UPDATE suggestion SET resultat = :resultat WHERE id_utilisateur = :id AND id_cible = :id_cible');
    $update->execute(array(
      "resultat" => $resultat,
      "id" => $this->_id,
      "id_cible" => $id_cible
    ));

    return $update;
  }

  public function updateMatchNonLuMysql($statut) {
    $update = $this->_bdd->prepare('UPDATE suggestion s
      INNER JOIN suggestion s2
      ON s.id_cible = s2.id_utilisateur

      INNER JOIN utilisateur u
      ON u.id = s.id_cible

      SET s.etat_lu = 1

      WHERE s.id_utilisateur = :id
      AND s.resultat = 1

      AND s2.id_cible = :id
      AND s2.resultat = 1

      AND u.statut <> :statut
    ');
    $update->execute(array(
      "id" => $this->_id,
      "statut" => $statut
    ));

    return $update;
  }

  public function updateMatchNonLuPostgre($statut) {
    $update = $this->_bdd->prepare('UPDATE suggestion s
      SET etat_lu = 1

      FROM suggestion s2, utilisateur u
      WHERE s.id_cible = s2.id_utilisateur
      AND u.id = s.id_cible
      AND s.id_utilisateur = :id
      AND s.resultat = 1

      AND s2.id_cible = :id
      AND s2.resultat = 1

      AND u.statut <> :statut
    ');
    $update->execute(array(
      "id" => $this->_id,
      "statut" => $statut
    ));

    return $update;
  }


  /*
  * @brief Vérifie si le user $id est un match possible du user $this->_id
  */
  public function issetMatch($id, $statut, $search_sexe, $search_sexe2) {
    $isset_match = $this->_bdd->prepare('   SELECT p.id_utilisateur FROM profil p

	  LEFT JOIN suggestion s
    ON p.id_utilisateur = s.id_cible
    AND s.id_utilisateur = :id_user

    INNER JOIN utilisateur u
    ON u.id = p.id_utilisateur

    WHERE s.id_cible = :id
    AND p.id_utilisateur <> :id_user
    AND (id_sexe = :search_sexe OR id_sexe = :search_sexe2)
    AND u.statut <> :statut

      ');
    $isset_match->execute(array(
      "id" => $id,
      "id_user" => $this->_id,
      "statut" => $statut,
      "search_sexe" => $search_sexe,
      "search_sexe2" => $search_sexe2
    ));

    return $isset_match;
  }




  public function setNewMatch($id, $result, $etat) {
    $insert = $this->_bdd->prepare('INSERT INTO suggestion(id_cible, id_utilisateur, resultat, etat_lu, date_match) VALUES(:id_cible, :id_utilisateur, :resultat, :etat_lu, NOW())');
    $insert->execute(array(
      "id_cible" => $id,
      "id_utilisateur" => $this->_id,
      "resultat" => $result,
      "etat_lu" => $etat
    ));

    return $insert;
  }


  /*
  * @brief Nombre de matchs par rapport à la table suggestion
  * @detail On fait une autjointure de la table match pour faire correspondre les personnes qui se sont matche
  */
  public function countMatch() {
    $count = $this->_bdd->prepare('SELECT COUNT(*) as count
      FROM suggestion s

      LEFT OUTER JOIN suggestion s1
      ON s.id_cible = s1.id_utilisateur
      AND s.id_utilisateur = s1.id_cible

      WHERE s1.id_utilisateur IS NOT NULL
      AND s1.id_utilisateur = :id
      AND s.resultat = 1
      AND s1.resultat = 1
      ');
    $count->execute(array("id" => $this->_id));

    return $count;
  }

  /*
  * @brief Nombre de matchs par rapport à a table suggestion
  * @detail On fait une auto-jointure de la table match pour faire correspondre les personnes qui se sont matche
  */
  public function countMatchNonLu() {
    $count = $this->_bdd->prepare('SELECT COUNT(*) as count
      FROM suggestion s

      LEFT OUTER JOIN suggestion s1
      ON s.id_cible = s1.id_utilisateur
      AND s.id_utilisateur = s1.id_cible

      WHERE s1.id_utilisateur IS NOT NULL
      AND s1.id_utilisateur = :id
      AND s.resultat = 1
      AND s1.resultat = 1

      AND s1.etat_lu = 0
      ');
    $count->execute(array("id" => $this->_id));

    return $count;
  }

  /*
  * @brief Vérifie si la personne suggérée à bien matché le $this->_id
  */
  public function checkMatch($id) {
    $check = $this->_bdd->prepare('SELECT id_utilisateur FROM suggestion
      WHERE id_cible = :id_cible
      AND id_utilisateur = :id_utilisateur
      AND resultat = 1');

    $check->execute(array(
      "id_cible" => $this->_id,
      "id_utilisateur" => $id
    ));

    return $check;
  }


  /******************************/


  /*
  * @brief Création d'un tuple
  */
  public static function creataNewTsuggestion($bdd, $id) {
      $insert = $bdd->prepare('INSERT INTO suggestiontotal(id_utilisateur, date_update) VALUES(:id, NOW())');
      $insert->execute(array("id" => $id));

      return $insert;
  }

  public static function updateMatchCumulePlus($bdd, $id) {
    $update = $bdd->prepare('UPDATE suggestiontotal SET nombre_match_cumule = nombre_match_cumule + 1, date_update = NOW() WHERE id_utilisateur = :id_utilisateur');
    $update->execute(array("id_utilisateur" => $id));

    return $update;
  }
  /*
  * @bbrief Retourne le nombre de match cumulé (même si un utilisateur matché n'existe plus)
  */
  public function countMatchCumule() {
    $count = $this->_bdd->prepare('SELECT nombre_match_cumule
      FROM suggestiontotal
      WHERE id_utilisateur = :id
    ');
    $count->execute(array("id" => $this->_id));

    return $count;
  }


}
