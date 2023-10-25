<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

if (isset($_SESSION['user_id'])) {
    session_unset();
    session_destroy();
    header("Location: ../default/homepage.php");
    exit();
}
?>