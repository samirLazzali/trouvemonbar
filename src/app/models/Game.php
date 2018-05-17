<?php
/**
*
 *
 * Created by PhpStorm.
 * User: jo
 * Date: 24/04/18
 * Time: 18:17
 * Class Game
 * For the purpose of this app, a "game" is a role-playing game session that is scheduled by a User
 */
class Game
{
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->gameid;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->gamename;
    }

    /**
     * @return mixed
     */
    public function getDesc()
    {
        return $this->gamedesc;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @return mixed
     */
    public function isPrivate()
    {
        return $this->private;
    }

    /**
     * @return mixed
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @return mixed
     */
    public function getIllustration()
    {
        return $this->illustration;
    }

    private $gameid, $gamename, $gamedesc, $duration, $private, $creator, $illustration, $gamesystemid;

    /**
     * Game constructor.
     * @param $gameid int id de la partie
     * @throws Exception
     */
    public function __construct($gameid)
    {

        $query = db()->prepare("SELECT * FROM game WHERE gameid = ?");
        $query->execute([$gameid]);

        if($query->rowCount() != 1) return "Game can't be found :".$gameid;

        $game=$query->fetch();

        //inject results from database columns into the object
        foreach (['gameid', 'gamename', 'gamedesc', 'duration', 'private', 'gamesystemid', 'creator', 'illustration' ] as $attr)
        {
            $this->$attr = $game->$attr;
        }


    }

    /**
     * @param $gamename
     * @param $gamedesc
     * @param $duration
     * @param $gamesystemid
     * @param $creator
     * @param false $private boolean
     * @param null $illustration
     * @return int db()->lastInsertId() id of the game which was just created if successful
     * @todo add check if name already exists
     */
    public static function insert_game($gamename, $gamedesc, $duration, $gamesystemid, $creator, $illustration=null, $private=false)
    {
        $query = db()->prepare("INSERT INTO game (gamename, gamedesc, duration, gamesystemid, creator, illustration) VALUES  (?, ?, ?, ?, ?, ?)");
        $success = $query->execute([$gamename, $gamedesc, $duration, $gamesystemid, $creator, $illustration]);

        if($success)
            return db()->lastInsertId("game_gameid_seq");
        else
            return false;
    }

    /**
     * @return array list of all games in the database
     */
    public static function gamelist()
    {

        $query = db()->prepare("SELECT gameid, gamename FROM game");
        $query->execute();

        return $query->fetchAll();
    }

    /**
     * @return array list of the oneshot schedules available for this game
     */
    public function one_shot_schedules()
    {
        $query=db()->prepare("SELECT * from oneshot where gameid = ? ");
        $query->execute([$this->gameid]);

        return $query->fetchAll();

    }

    /**
     * @return mixed
     */
    public function getGamesystemid()
    {
        return $this->gamesystemid;
    }

    /**
     * @return array list of the reccurretn schedules available for this game
     */
    public function reccurrent_schedules()
    {
        $query=db()->prepare("SELECT * FROM reccurrent WHERE gameid = ?");
        $query->execute([$this->gameid]);

        return $query->fetchAll();
    }

    /**
     * @return array list of comments for this game
     */
    public function comments()
    {
        $query=db()->prepare("SELECT * from comment WHERE gameid = ? ");
        $query->execute([$this->gameid]);

        return $query->fetchAll();
    }

    /**
     * @return array list of players (non gm) for this game
     */
    public function players()
    {
        $query = db()->prepare('SELECT * FROM users NATURAL JOIN participation NATURAL JOIN game
                                          WHERE gameid = ?');
        $query->execute([$this->gameid]);

        return $query->fetchAll();
    }

}











