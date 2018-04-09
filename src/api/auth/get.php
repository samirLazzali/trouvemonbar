<?php

require_once("../../config.php");

$user = getUserFromCookie();
if ($user == null)
    $result = array("log_status" => "logged_out", "user" => null);
else
    $result = array("log_status" => "logged_in", "user" => $user);

success_die($result);