<?php
	require_once __DIR__ . "./../config.php";
    session_start();
    setcookie("CurrentUser", "", time() - 3600, "/");
    session_destroy();
    header("Location: ./../Home.php");
    exit;
?>
