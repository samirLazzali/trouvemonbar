<?php
/**
 * Signale un utilisateur
 * Méthode : POST
 * Paramètres :
 * - user   : l'identifiant ou le nom d'utilisateur de l'utilisateur que l'on souhaite signaler
 * - reason : la raison du signalement
 * Renvoie :
 * - status = success en cas de réussite
 * - status = error si le post est inconnu, l'utilisateur n'est pas connecté
 */

require_once("../../config.php");
require_once("Report.php");

if (isset($_POST['user']))
    $identifier = $_POST['user'];
else
    error_die("user", ERROR_FieldMissing);

if (isset($_POST['reason']))
    $reason = $_POST['reason'];
else
    $reason = null;

$user = verify_logged_in();

try
{
    $toReport = User::findWithIDorUsername($identifier);
}
catch (UserNotFoundException $e)
{
    error_die($e->getMessage(), ERROR_NotFound);
}

$report = UserReport::create($toReport, $reason, $user);
success_die($report);