<?php

    error_reporting(E_ALL);
    ini_set("display_errors", true);

    define('VERSION', 'dev');
    define('PASSWORD', 'terro123');

    session_start();

    include("classes/Terro.php");
    include("classes/TerroManager.php");
    include("classes/Storage.php");
    include("classes/Server.php");
    include("classes/AjaxControl.php");
    include("classes/Ajax.php");

    try {
        $terro = new TerroManager(PASSWORD);
    } catch (Exception $e) {
        print_r($e);
        exit;
    }

    include("views/layout.php");