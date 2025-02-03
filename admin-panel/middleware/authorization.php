<?php
    error_reporting(0);
    session_start();
    require_once __DIR__ . "/../../modules/users/authentication.php";
    require_once __DIR__ . "/../../modules/users/user.php";
    require_once __DIR__ . "/../../modules/database/database.php";
    require_once __DIR__ . "/../../modules/jdate/jdf.php";
    require_once __DIR__ . "/../../modules/bot/bot.php";

    $auth = new Authentication(new User(), new Database());

    if(!$auth->isAuthenticated($_SESSION['token'])){
        unset($_SESSION['token']);
        header("Location: login.php");
        exit();
    }