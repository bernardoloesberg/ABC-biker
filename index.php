<?php
    // Error reporting
    error_reporting(E_ALL);
    // Start session
    session_start();

    // Security
    include_once('code/controllers/security.php');

    include_once('code/controllers/LayoutController.php');
    include_once('pages/main.php');

    // Website
    startBootstrap();
        getMenu();
            getContent();
        getFooter();
    closeBootstrap();