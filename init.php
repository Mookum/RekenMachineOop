<?php
    session_start();

    error_reporting(-1);
    ini_set('display_errors', 'On');

    $_SESSION['aantal'] = isset($_SESSION['aantal']) ? $_SESSION['aantal'] : 0;
    $_SESSION['currentValue'] = isset($_SESSION['currentValue']) ? $_SESSION['currentValue'] : 0;
    $_SESSION['history'] = isset($_SESSION['history']) ? $_SESSION['history'] : array();
    $_SESSION['deleted'] = isset($_SESSION['deleted']) ? $_SESSION['deleted'] : array();
    $_SESSION['delete'] = isset($_SESSION['delete']) ? $_SESSION['delete'] : array();
    $_SESSION['lastAction'] = false;

    $errorFirst = false;
    $errorLast = false;
    $errorBewerking = false;

    require 'RekenMachine.php';