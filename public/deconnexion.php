<?php
include "vue.php";
session_start();
session_destroy();

header('Location: index.php');
?>