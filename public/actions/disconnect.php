<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 05/05/18
 * Time: 23:51
 */

require "../../src/app/helpers.php";
Auth::logout();
redirect("../index.php");