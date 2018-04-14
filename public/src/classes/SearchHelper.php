<?php
require_once("User.php");

abstract class Search implements JsonSerializable
{
    const MODE_ANY = "Any";
    const MODE_ALL = "All";

    const MODE_CONTAINS = "Contains";
    const MODE_WORDS = "Words";

//    public static function User($terms, $mode = MODE_ALL, $words = MODE_CONTAINS)
//    {
//        $SQL = "SELECT * FROM User WHERE ";
//        if ($mode == MODE_ANY)
//        {
//            $SQL .= "Username IN ("
//            foreach($terms as $term)
//            {
//
//            }
//        }
//    }

    /**
     * Recherche des utilisateurs.
     * @param string $term les paramètres de recherche
     * @param int $limit le nombre maximum de résultats à renvoyer
     * @return array un tableau de User
     */
    public static function User($term, $limit = 50)
    {
        $db = connect();
        $SQL = "SELECT * FROM " . TABLE_User . " WHERE Username LIKE :term LIMIT $limit";
        $statement = $db->prepare($SQL);
        $statement->bindValue(":term", "%" . $term . "%");
        $statement->execute();
        $rows = $statement->fetchall();

        $results = array();
        foreach($rows as $row)
            array_push($results, User::fromRow($row));
        return $results;
    }

    /**
     * Recherche des posts.
     * @param string $term les paramètres de recherche
     * @param int $limit le nombre maximum de résultats à renvoyer
     * @return array un tableau de Post
     */
    public static function post($term, $limit = 50)
    {
        $db = connect();
        $SQL = "SELECT * FROM " . TABLE_Posts . " WHERE Content LIKE :term LIMIT $limit";
        $statement = $db->prepare($SQL);
        $statement->bindValue(":term", "%" . $term . "%");
        $statement->execute();
        $rows = $statement->fetchall();

        $results = array();
        foreach($rows as $row)
            array_push($results, Post::fromRow($row));
        return $results;
    }

    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
    }
}