<?php

session_start();

function isUserLoggedIn() {
    return isset($_SESSION['uid']);
}

function clearSession() {
    $_SESSION = array();
    session_destroy();
}

function sessioncheck() {
    return isset($_SESSION['session_token']);
}
?>