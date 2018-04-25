<?php

require_once("../config.php");

$u = getUserFromCookie();

if ($u == null)
    header("Location: /signup");
else
    header("Location: /main");