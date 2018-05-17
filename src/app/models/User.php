<?php

/**
 * Class User
 * @brief login info for a user
 */
class User
{

    ///
    /// Static part
    ///

    /**
     * @brief check if the user is in the database
     * @param $login string login
     * @param $passwd string password
     * @todo add safe password storing and checking (with hashes)
     * @return false if no matching user or password is wrong.
     * userId if a user is found and password is correct
     */
    public static function check($login, $passwd)
    {
        //query
        $query = db()->prepare("SELECT userid, password FROM users WHERE mail = ?");
        $query->execute([$login]);

        //if we found at least one result
        if($query->rowCount() != 0)
        {
            $result = $query->fetch(PDO::FETCH_ASSOC);
            $hash = $result['password'];

            if( password_verify( $passwd, $hash))
                return $result['userid'];
            else return false;
        }
        else
            return false;

    }

    ///
    /// Object part
    ///
    public $userid, $password,$nick, $mail, $firstname, $lastname;
    /**
     * User constructor.
     * @param $idUser int
     * @throws exception user does not exist
     */
    public function __construct($idUser)
    {
        //query
        $query = db()->prepare("SELECT * FROM users WHERE userid = ?");
        $query->execute([$idUser]);

        if($query->rowCount() != 1) throw  new  Exception("User can't be found :".$idUser );

        $user = $query->fetch();

        //inject results from database columns into the object
        foreach (['userid', 'password', 'nick', 'mail', 'firstname', 'lastname'] as $attr)
        {
            $this->$attr = $user->$attr;
        }

    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * Update the user's password and mail
     * @param $passwd
     * @param $mail
     * @todo fill.
     */
    public function updateUser($passwd, $mail)
    {

    }

    /**
     * Add a new user in the database
     * @param $nick
     * @param $passwd
     * @param $mail
     * @return string db()->lastInsertId() id of the user who was just added in case of success
     * @todo add check if mail or nick already exists
     */
    public static function insertUser($nick, $passwd, $mail)
    {

        $query = db()->prepare("INSERT INTO users (nick, mail, password) VALUES( ?, ?, ? )");
        $success = $query->execute([$nick, $mail, password_hash( $passwd, PASSWORD_DEFAULT)]);
        if($success)
            return db()->lastInsertId('user_userid_seq');

        else
            return false;
    }

    /**
     * todo : a list of all ids of all the games of the user
     */
    public function hisGames()
    {

    }

    /**
     * todo idem with systems
     */
    public function hisSystems()
    {

    }

    ///
    /// GETTERS AND SETTERS
    ///
    /**
     * @return int
     */
    public function getId()
    {
        return $this->userid;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId($id)
    {
        $this->userid = $id;
        return $this;
    }

    public function getNick()
    {
        return $this->nick;
    }

    public function setNick($nick)
    {
        $this->$nick = $nick;
        return $this;
    }

}

