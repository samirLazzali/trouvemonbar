<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 24/04/18
 * Time: 14:51
 * This file contains the authentication functions
 */


/**
 * Class Auth
 * Singleton
 * Holds info about who is logged in
 * @todo make singleton
 */
class Auth
{

    private static $user = false;

    /**
     * @brief called automatically when the app is launched
     */
    public static function get_user()
    {
        if(!empty($_SESSION['user'])) {
            try {
                self::$user = new User($_SESSION['user']);
            }
            catch(\Exception $e)
            {
                self::logout();
                error(500);
            }
        }
    }

    /**
     * @brief create the user session
     * @param string user id
     */
    public static function login($id)
    {
        $_SESSION['user'] = $id;
    }

    /**
     * @return mixed User current user
     */
    public static function user()
    {
         return self::$user;
    }


    /**
     * @return true if user is logged in
     */
    public static function logged()
    {
        return !empty($_SESSION['user']);
    }

    /**
     * @brief destroy the session
     */
    public static function logout()
    {
        unset($_SESSION['user']);
    }

}


