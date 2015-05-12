<?php
    /**
     * @author: Bernardo Loesberg
     */

    // Fix for images and urls when running on localhost.
    $_SESSION['rooturl'] = '/ABC-biker';

    // Starting the site with bootstrap
    function startBootstrap(){
        echo '<!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="utf-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <title>Website</title>

                        <!-- jQuery (necessary for Bootstraps JavaScript plugins) -->
                        <script src="'.$_SESSION['rooturl'].'/code/js/jQuery.js"></script>

                        <!-- Bootstrap -->
                        <link href="'.$_SESSION['rooturl'].'/code/css/bootstrap.min.css" rel="stylesheet" />

                        <!-- Website CSS -->
                        <link href="'.$_SESSION['rooturl'].'/code/css/style.css" rel="stylesheet" type="text/css"  media="screen" />

                        <!--[if lt IE 9]>
                        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
                        <![endif]-->
                    </head>
                    <body>
                        <div class="container">';
    }

    // Closing the site with bootstrap
    function closeBootstrap(){
        echo '          </div>
                    <!-- Include all compiled plugins (below), or include individual files as needed -->
                    <script src="'.$_SESSION['rooturl'].'/code/js/bootstrap.min.js"></script>
                    </body>
                  </html>';
    }

    // Start a div with tags
    function startDiv($type, $value){
        echo '<div '.$type.'="'.$value.'">';
    }

    // Close the div
    function closeDiv(){
        echo '</div>';
    }

    // Load javascript files
    function loadscript($src){
        echo '<script src="'.$src.'" type="text/javascript"></script>';
    }

    // Create div element and add html code to it
    function createDiv($type, $value, $html){
        echo '<div '.$type.'="'.$value.'">'.$html.'</div>';
    }

    // Show messages types (success, info, warning, danger)
    function showMessage($type, $text){
        echo '<div class="alert alert-'.$type.'">'.$text.'</div>';
    }

    // Load page without header function because header function gives bugs!
    function loadpage($path){
        echo '<script type="text/javascript">
                    window.location = "'.$path.'";
                  </script>';
    }