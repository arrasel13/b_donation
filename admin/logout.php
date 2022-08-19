<?php

session_start();
include_once 'db/connection.php';

if (isset($_SESSION['username']) || isset($_COOKIE['auth'])){
    unset($_SESSION['username']);

    if(isset($_COOKIE['auth'])){
        setcookie('auth','', time()-3600);
    }

    $_SESSION['msg'] = "Logged Out successfully";
    header("Location: ../login.php?status=success");
}