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
    public $userid, $password,$nick, $mail, $firstname, $lastname, $isAdmin;
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
        foreach (['userid', 'password', 'nick', 'mail', 'firstname', 'lastname', 'isAdmin'] as $attr)
        {
            $this->$attr = $user->$attr;
        }

    }

    /**
     * @return true if user is admin
     */
    public function isAdmin()
    {
        return $this->isAdmin;
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
     * @return bool true if update successful
     */
    public function updateUser($passwd, $mail)
    {
        $query = db()->prepare("UPDATE users SET mail=?,password=? WHERE userid=?");
        $success = $query->execute([$mail, password_hash( $passwd, PASSWORD_DEFAULT),$this->userid]);
        if($success)
            return true;

        else
            return false;
    }

    public function updateUser_profile($nick, $firstname, $lastname, $mail,$passwd)
    {
        if($passwd == null)
        {
            $query = db()->prepare("UPDATE users SET nick=?,firstname=?,lastname=?,mail=? WHERE userid=?");
            $success = $query->execute([$nick,$firstname,$lastname,$mail,$this->userid]);
        }
        else
        {
            $query = db()->prepare("UPDATE users SET nick=?,firstname=?,lastname=?,mail=? ,password=? WHERE userid=?");
            $success = $query->execute([$nick,$firstname,$lastname, $mail, password_hash( $passwd, PASSWORD_DEFAULT),$this->userid]);
        }

        if($success)
            return true;

        else
            return false;
    }
    /**
     * Add a new user in the database
     * @param $nick
     * @param $passwd
     * @param $mail
     * @return string db()->lastInsertId() id of the user who was just added in case of success
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
     * @param $gamesystemid
     * @param $userid
     * @return bool|string
     */
    public static function insertMastery($gamesystemid, $userid)
    {

        $query = db()->prepare("INSERT INTO mastery (gamesystemid, userid) VALUES( ?, ?)");
        return $query->execute([$gamesystemid, $userid]);

    }

    /**
     * @param $userid
     * @return array all gamesystemids of user
     */
    public static function masterylist($userid)
    {

        $query = db()->prepare("SELECT gamesystemid FROM mastery WHERE userid=?");
        $query->execute([$userid]);

        return $query->fetchAll();
    }

    /**
     * @param system test
     * @return bool true id the user gm's this system.
     */
    public function masters($gamesystemid)
    {
        $query = db()->prepare("SELECT * FROM mastery WHERE userid = ? AND gamesystemid = ?");
        $query->execute([$this->userid, $gamesystemid]);
        return $query->rowCount() > 0;

    }
    /**
     * @return array list of the games for which the user is GM
     */
    public function gm_for()
    {
        $query = db()->prepare("SELECT * FROM game, users WHERE game.creator = users.userid AND userid= ?");
        $query->execute([$this->userid]);

        return $query->fetchAll();
    }


    public function pc_for()
    {
        $query = db()->prepare("SELECT * FROM game NATURAL JOIN participation WHERE userid= ?");
        $query->execute([$this->userid]);

        return $query->fetchAll();
    }

    /**
     * idem with systems
     */
    public function hisSystems()
    {

        $query = db()->prepare("SELECT * FROM user NATURAL JOIN mastery NATURAL JOIN gamesystem WHERE userid= ?");
        $query->execute([$this->userid]);

        return $query->fetchAll();
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

    /**
     * @return array list of all users and game created  in the database
     */
    public static function usergamelist()
    {

        $query = db()->prepare("SELECT userid,nick,firstname,lastname,gamename,gameid FROM users left join game on userid=creator");
        $query->execute();

        return $query->fetchAll();
    }

    public static function searchlist($arr)
    {
        $query = db()->prepare($arr);
        $query->execute();

        return $query->fetchAll();
    }

    public function hisfiles()
    {
        $query = db()->prepare("SELECT * from file WHERE userid = ?");
        $query->execute([$this->userid]);

        return $query->fetchAll();
    }

    /**
     * @return array list of all users  in the database
     */
    public static function userlist()
    {

        $query = db()->prepare("SELECT userid,nick,firstname,lastname FROM users ");
        $query->execute();

        return $query->fetchAll();
    }






}

