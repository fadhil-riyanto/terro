<?php

    define('VERSION', 'dev');
    define('PASSWORD', 'terro123');

    include("classes/Terro.php");
    include("classes/Server.php");
    $terro = new Terro(PASSWORD);

    include("views/layout.php");
?>

