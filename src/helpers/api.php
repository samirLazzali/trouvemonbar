<?php

require_once("User.php");

function json_die($status)
{
    echo json_encode($status);
    die();
}

function error_die($status)
{
    $status = array("status" => "error", "result" => null, "description" => $status);
    json_die($status);
}

function success_die($result)
{
    $status = array("status" => "success", "result" => $result);
    json_die($status);
}

function getUserFromCookie()
{
    if (!isset($_COOKIE[AUTH_COOKIE_NAME]))
        return null;
    else
    {
        $cookie = $_COOKIE[AUTH_COOKIE_NAME];
        $userId = explode(":", $cookie)[0];

        try
        {
            $user = User::fromID($userId);
        }
        catch (UserNotFoundException $e)
        {
            echo "<!-- Wrong cookie detected. -->";
            return null;
        }

        $hash = $user->getHash();
        if (hash('sha512', $hash) == explode(":", $cookie)[1])
            return $user;
        else
            return null;
    }
}

function authenticate($user)
{
    $cookieVal = $user->getID() . ":" . hash('sha512', $user->getHash());

    // Expiration dans 24h :
    $cookieExp = time() + AUTH_COOKIE_EXP;

    setcookie(AUTH_COOKIE_NAME, $cookieVal, $cookieExp, "/");
}

function log_out()
{
    $cookieExp = time() + AUTH_COOKIE_EXP;
    setcookie(AUTH_COOKIE_NAME, "", $cookieExp, "/");
}

function verify_logged_in()
{
    $u = getUserFromCookie();
    if ($u == null)
        error_die("User not logged in.");

    return $u;
}