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
            $expectedPasswo = $result['password'];
            if($expectedPasswo === $passwd)
                return $result['userid'];
            else return false;
        }
        else {
            flash("no results </br>");
            return false;
        }
    }

    ///
    /// Object part
    ///
    public $userid, $password,$nick, $mail, $firstname, $lastname;
    /**
     * User constructor.
     */
    public function __construct($idUser)
    {
        //query
        $query = db()->prepare("SELECT * FROM user WHERE userid = ?");
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
     * @todo fill
     */
    public function insertUser($nick, $passwd, $mail)
    {

    }
    /**
     * @return int
     */
    public function getId()
    {
        return $this->idUser;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getNick()
    {
    }

    public function setNick($nick)
    {
        $this->$nick = $nick;
        return $this;
    }

}

