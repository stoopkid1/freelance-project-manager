<?php session_start();
unset($_SESSION['fpm_username']);
unset($_SESSION['fpm_admin']);
session_destroy();

header("Location: index.php");
?>