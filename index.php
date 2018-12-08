<?php
    // TODO: FIX: dev file
include 'app/components/dev.php';

    session_start();

    define('ROOT', dirname(__FILE__));
    require 'app/components/autoload.php';

    $router = new Router();
?>