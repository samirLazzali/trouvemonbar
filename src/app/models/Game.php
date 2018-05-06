<?php
/**
 *
 * Created by PhpStorm.
 * User: jo
 * Date: 24/04/18
 * Time: 18:17
 */


/**
 * Class Game
 * For the purpose of this app, a "game" is a role-playing game session that is scheduled by a User
 */
class Game
{
    public function __construct()
    {

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