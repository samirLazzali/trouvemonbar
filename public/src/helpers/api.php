<?php

require_once("User.php");

/**
 * Affiche un paramètre sérialisé en JSON puis arrête l'exécution du script.
 * @param JsonSerializable $status l'objet à sérialiser et afficher.
 */
function json_die($status)
{
    echo json_encode($status);
    die();
}

/**
 * Affiche un message d'erreur et arrête l'exécution du script.
 * @param JsonSerializable $status le message d'erreur (ou un JsonSerializable)
 * @param int $status le statut (HTTP) de l'erreur
 */
function error_die($description, $status = STATUS_OK)
{
    $message = array("status" => $status, "result" => null, "description" => $description);
    json_die($message);
}

/**
 * Affiche un message de succès et arrête l'exécution du script.
 * @param JsonSerializable $result le message de succès (ou un JsonSerializable)
 * @param boolean $show_timestamp afficher le timestamp ou pas dans la réponse
 */
function success_die($result, $show_timestamp = true)
{
    $status = array("status" => 200, "result" => $result);
    if ($show_timestamp)
        $status["timestamp"] = time();
    json_die($status);
}

/**
 * Détermine une instance d'utilisateur correspondant au cookie d'authentification sur la machine du client.
 * @return null|User null si aucun utilisateur n'est connecté ou si le cookie est invalide ; sinon un User
 */
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

/**
 * Définit le cookie d'authentification de manière à connecter un utilisateur
 * @param User $user l'utilisateur à connecter
 */
function authenticate($user)
{
    $cookieVal = $user->getID() . ":" . hash('sha512', $user->getHash());

    // Expiration dans 24h :
    $cookieExp = time() + AUTH_COOKIE_EXP;

    setcookie(AUTH_COOKIE_NAME, $cookieVal, $cookieExp, "/");
}

/**
 * Définit le cookie d'authentification de manière à déconnecter l'utilisateur.
 */
function log_out()
{
    $cookieExp = time() + AUTH_COOKIE_EXP;
    setcookie(AUTH_COOKIE_NAME, "", $cookieExp, "/");
}

/**
 * Vérifie si un utilisateur est connecté, renvoie son instance si c'est le cas, sinon null.
 * @return null|User
 */
function verify_logged_in()
{
    $u = getUserFromCookie();
    if ($u == null)
        error_die("User not logged in.", ERROR_LoggedOut);

    return $u;
}