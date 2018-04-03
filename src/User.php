<?php

require_once("db.php");
require_once("Post.php");

class User
{
    private $ID;
    private $username;
    private $email;
    private $isModerator;

    public function getID()
    {
        return $this->ID;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getModerator()
    {
        return $this->isModerator;
    }

    function __construct($ID, $username, $email)
    {
        $this->ID = $ID;
        $this->username = $username;
        $this->email = $email;
    }

    static function fromRow($row)
    {
        $u = new User($row["ID"], $row["Username"], $row["Email"]);
        $u->setModerator($row["IsModerator"]);
    }

    static function fromID($ID)
    {
        $db = connect();
        $SQL = "SELECT * FROM $TABLE_User WHERE ID = ':id'";
        $statement = $db->prepare($SQL);
        $statement->bindParam(":id", $ID);
        $statement->execute();
        $row = $statement->fetch();

        return fromRow($row);
    }
    
    static function testPassword($ID, $attempt)
    {
        die("TODO: User::testPassword");
    }

    function findPosts($limit = 50)
    {
        $db = connect();
        $SQL = "SELECT * FROM Posts WHERE Author = :id LIMIT $limit ORDER BY Timestamp DESC";
        $statement = $db->prepare($SQL);
        $statement->bindParam(":id", $this->getID());
        $statement->execute();
        $rows = $statement->fetchall();

        $posts = array();
        foreach($rows as $row)
        {
            array_push($posts, Post::fromRow($row));
        }
        return $posts;
    }
    
    function update($newId, $newEmail, $newUsername)
    {
        $db = connect();
        
        $this->ID = $newId;
        $this->email = $newEmail;
        $this->username = $newUsername;

        die("TODO: User::update");
    }

    function delete()
    {
        $db = connect();
        die("TODO: User::delete");
    }
}