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
     */
    public static function game_created($game)
    {
        $systemname = Gamesystem::id_to_name($game->getGamesystemid());
        $creator = null;
        $subject = wordwrap( getenv('SUBJECT_HEADER')." ".$game->getName()." (".$systemname.")", 70);
        try {
            $creator = new User($game->getCreator());
        }catch (Exception $e)
        {
            error("500");
        }
        $body = wordwrap($game->getName(), 70);
        flash(getenv('MAILING_LIST'));

        mail(getenv('MAILING_LIST'), $subject, $body);

    }
}