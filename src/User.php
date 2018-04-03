<?php

class User
{
    private $ID;
    private $username;
    private $email;

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

    function __construct($ID, $username, $email)
    {
        $this->ID = $ID;
        $this->username = $username;
        $this->email = $email;
    }

    function fromID($ID)
    {
        $u = new User($ID, null, null);
        $SQL = "SELECT * FROM $TABLE_User WHERE ID = ':id'";
        die("TODO: User::fromID");
    }
    
    function findPosts()
    {
        $SQL = "SELECT * FROM Posts WHERE Author = :id";
        die("TODO: User::findPosts");
    }
    
    function update($newId, $newEmail, $newUsername)
    {
        die("TODO: User::update");
    }

    function delete()
    {
        die("TODO: User::delete");
    }
}