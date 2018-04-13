<?php

if (!defined('__ROOT__')) define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__ . '/config.php');
require_once(__ROOT__ . '/classes/Post.php');

class User implements JsonSerializable
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

    public function setModerator($newModerator)
    {
        $this->isModerator = $newModerator;
    }

    public function getHash()
    {
        $db = connect();
        $SQL = "SELECT Password FROM " . TABLE_User . " WHERE ID = :id";
        $statement = $db->prepare($SQL);
        $statement->bindValue(":id", $this->getID());
        $statement->execute();
        $row = $statement->fetch();

        return $row["password"];
    }

    function __construct($ID, $username, $email)
    {
        $this->ID = $ID;
        $this->username = $username;
        $this->email = $email;
    }

    static function fromRow($row)
    {
        $u = new User($row["id"], $row["username"], $row["email"]);
        $u->setModerator($row["moderator"] == "false" ? false : true);

        return $u;
    }

    static function fromID($ID)
    {
        $db = connect();
        $SQL = "SELECT * FROM " . TABLE_User . " WHERE ID = :id";
        $statement = $db->prepare($SQL);
        $statement->bindParam(":id", $ID);
        $statement->execute();
        $row = $statement->fetch();

        if (!$row)
            throw new UserNotFoundException(UserNotFoundException::Given_ID, $ID);

        return User::fromRow($row);
    }

    static function fromUsername($username)
    {
        $db = connect();
        $SQL = "SELECT * FROM " . TABLE_User . " WHERE Username = :username";
        $statement = $db->prepare($SQL);
        $statement->bindParam(":username", $username);
        $statement->execute();
        $row = $statement->fetch();

        if (!$row)
            throw new UserNotFoundException(UserNotFoundException::Given_Username, $username);

        return User::fromRow($row);
    }

    static function findWithUsernameOrEmail($identifier)
    {
        if (User::usernameExists($identifier))
            return User::fromUsername($identifier);
        elseif (User::emailExists($identifier))
            return User::fromEmail($identifier);

        throw new UserNotFoundException(UserNotFoundException::Given_UsernameOrEmail, $identifier);
    }

    static function findWithIDorUsername($data)
    {
        try
        {
            $u = User::fromID($data);
            return $u;
        }
        catch (UserNotFoundException $e)
        {
            // On va essayer avec le nom d'utilisateur
        }

        try
        {
            $u = User::fromUsername($data);
            return $u;
        }
        catch (UserNotFoundException $e)
        {
            throw $e;
        }
    }
        
    static function emailExists($email)
    {
        $db = connect();
        $SQL = "SELECT ID FROM Users WHERE Email = :email";
        $statement = $db->prepare($SQL);
        $statement->bindParam(":email", $email);
        $statement->execute();
        $row = $statement->fetch();

        if (!$row)
            return false;
        else
            return true;
    }

    static function usernameExists($username)
    {
        $db = connect();
        $SQL = "SELECT ID FROM Users WHERE Username = :username";
        $statement = $db->prepare($SQL);
        $statement->bindParam(":username", $username);
        $statement->execute();
        $row = $statement->fetch();

        if (!$row)
            return false;
        else
            return true;
    }

    static function idExists($id)
    {
        $db = connect();
        $SQL = "SELECT ID FROM Users WHERE ID = :id";
        $statement = $db->prepare($SQL);
        $statement->bindParam(":id", $id);
        $statement->execute();
        $row = $statement->fetch();

        if (!$row)
            return false;
        else
            return true;

    }
    
    /* Insertion d'un utilisateur dans la base de données */
    static function create($username, $email, $password)
    {
        if (User::emailExists($email))
            throw new UserExistsException(UserExistsException::Duplicate_Email, $email);
        else if (User::usernameExists($username))
            throw new UserExistsException(UserExistsException::Duplicate_Username, $username);

        $hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
        $id = uniqid();

        $db = connect();
        $SQL = "INSERT INTO " . TABLE_User . " (ID, Username, Email, Password, Moderator) VALUES (:id, :username, :email, :password, false)";
        $statement = $db->prepare($SQL);
        $statement->bindParam(":id", $id);
        $statement->bindParam(":username", $username);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":password", $hash);
        $statement->execute();

        $u = new User($id, $username, $email);
        $u->setModerator(false);

        return $u;
    }

    static function testPassword($ID, $attempt)
    {
        $db = connect();
        $SQL = "SELECT Password FROM Users WHERE ID = :id";
        $statement = $db->prepare($SQL);
        $statement->bindParam(":id", $ID);
        $statement->execute();

        $row = $statement->fetch();
        $hash = $row["password"];

        return password_verify($attempt, $hash);
    }

    function findPosts($limit = 50)
    {
        $db = connect();
        $SQL = "SELECT * FROM " . TABLE_Posts . " WHERE Author = :id ORDER BY Timestamp DESC LIMIT $limit";
        $statement = $db->prepare($SQL);
        $statement->bindValue(":id", $this->ID);
        $statement->execute();
        $rows = $statement->fetchall();

        $posts = array();
        foreach($rows as $row)
            array_push($posts, Post::fromRow($row));
 
        return $posts;
    }
    
    function update($newId, $newEmail, $newUsername)
    {
        $db = connect();
        
        $this->ID = $newId;
        $this->email = $newEmail;
        $this->username = $newUsername;

        $SQL = "UPDATE User SET Email = :email, Username = :username";
        $statement = $db->prepare($SQL);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":username", $username);
        $statement->execute();

        if ($statement->rowCount() == 1)
            return true;
        else
            return false;
    }

    function delete()
    {
        $db = connect();
        
        $SQL = "DELETE FROM Users WHERE ID = :id";
        $statement = $db->prepare($SQL);
        $statement->bindParam(":id", $this->id);
        $statement->execute();

        if ($statement->rowCount() == 1)
            return true;
        else
            return false;
    }

    function jsonSerialize()
    {
        $arr = array("username" => $this->username,
            "id" => $this->ID,
            "isModerator" => $this->isModerator);

        return $arr;
    }
}

/**
 * Exception
 */
class UserNotFoundException extends Exception
{
    const Given_ID = 'ID';
    const Given_Username = 'Username';
    const Given_Email = 'Email';
    const Given_UsernameOrEmail = 'Username or Email';

    protected $given;
    protected $givenValue;

    public function __construct($given, $givenValue, $code = 0, Exception $previous = null) {
        $message = "Can't find user with $given = $givenValue";
        $this->given = $given;
        $this->givenValue = $givenValue;

        parent::__construct($message, $code, $previous);
    }
}

class UserExistsException extends Exception
{
    const Duplicate_Email = 'Email';
    const Duplicate_Username = 'Username';

    protected $duplicate;
    protected $duplicateValue;

    public function __construct($duplicate, $duplicateValue, $code = 0, Exception $previous = null)
    {
        $message = "The $duplicate '$duplicateValue' is already registered.";
        $this->duplicate = $duplicate;
        $this->duplicateValue = $duplicateValue;

        parent::__construct($message, $code, $previous);
    }
}
?>