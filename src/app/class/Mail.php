<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 18/05/18
 * Time: 00:09
 */

class Mail
{


    /**
     * @brief template and send mail in case of game creation
     * @param $game Game
     * @return bool
     */
    public static function game_created($game)
    {
        $systemname = Gamesystem::id_to_name($game->getGamesystemid());
        $creator = null;
        $subject = "un sujet";
        try {
            $creator = new User($game->getCreator());
        }catch (Exception $e)
        {
            error("500");
        }
        $body = "un contenu";
        $to = "josephine.barthel@free.fr";

         return mail($to, $subject, $body);

    }
}