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
    public function __construct()
    {

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
}