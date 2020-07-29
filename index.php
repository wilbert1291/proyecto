<?php
    date_default_timezone_set('America/Mexico_City');
    session_start();
    require_once 'libs/database.php';
    require_once 'libs/controller.php';
    require_once 'libs/view.php';
    require_once 'libs/model.php';
    require_once 'libs/app.php';
    require_once 'config/config.php';

    $app = new App();
?>