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
          $subject = getenv('SUBJECT_HEADER').$game->getName()."\r";
          $subject = wordwrap($subject, 70);
          try {
          $creator = new User($game->getCreator());
          }catch (Exception $e)
          {
              error("500");
          }
          $body = $creator->getNick()." propose une table de ".$systemname."\r";
          $body .= $game->getDesc()."\r";
          $body .= "Connectez vous à".getenv('ADRESS')." pour vous inscrire !";
          $body = wordwrap($body, 70);
          $to = getenv('MAILING_LIST');

          return mail($to, $subject, $body, $additional_parameters = null);


    }

}




















