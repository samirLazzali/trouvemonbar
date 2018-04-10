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

    public static function User($term)
    {
        $db = connect();
        $SQL = "SELECT * FROM " . TABLE_User . " WHERE Username LIKE :term";
        $statement = $db->prepare($SQL);
        $statement->bindValue(":term", "%" . $term . "%");
        $statement->execute();
        $rows = $statement->fetchall();

        $results = array();
        foreach($rows as $row)
            array_push($results, User::fromRow($row));
        return $results;
    }


    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
    }
}