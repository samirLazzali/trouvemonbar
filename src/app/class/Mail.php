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

        /**
         * $systemname = Gamesystem::id_to_name($game->getGamesystemid());
         * $creator = null;
         * $subject = "un sujet";
         * try {
         * $creator = new User($game->getCreator());
         * }catch (Exception $e)
         * {
         * error("500");
         * }
         * $body = "un contenu";
         * $to = "josephine.barthel@free.fr";
         *
         * return mail($to, $subject, $body);
         */


        $your_email = "josephine.barthel@free.fr"; // email address to which the form data will be sent
        $subject = "Little Treasures Contact Form"; // subject of the email that is sent
        $body = "test";
        $name = "Guiilde";
        $mail="no-reply@guiilde";
        $error_msg = array();


// Assuming there's an error, refresh the page with error list and repeat the form

        if ($error_msg) {
            //TODO fill
        }

        $email_body =
            "Name: $body\
                        \
                        ";

// Assuming there's no error, send the email and redirect to Thank You page

       return mail($your_email, $subject, $email_body, "From: $name <$mail>" . "\\r\
                                                            " . "Reply-To: $name <$mail>");


    }

}




















