<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 17/05/18
 * Time: 23:08
 */

class Participation
{

    /**
     * @brief insert a new player/game tuple in the db
     * @param $userid
     * @param $gameid
     * @return bool whether the insertion was successful or not
     */
    public static function insert_participation($userid, $gameid)
    {
        $query = db()->prepare("INSERT INTO participation (userid, gameid) VALUES (?, ?)");
        $success = $query->execute([$userid, $gameid]);

        return $success;

    }

    /**
     * @param $userid
     * @param $gameid
     * @return bool true if user participates to game as a player or gm
     */
    public static function is_participating($userid, $gameid)
    {
        $query = db()-> prepare("SELECT * FROM participation WHERE userid = ? AND gameid = ? ");
        $query->execute([$userid, $gameid]);

        $query_bis = db()->prepare("SELECT * FROM game, users WHERE users.userid = game.creator 
                                                                        AND users.userid = ? 
                                                                        AND game.gameid = ?");
        $query_bis->execute([$userid, $gameid]);

        return ($query->rowCount() > 0 || $query_bis->rowCount() > 0);
    }
}