<?php
    include_once('ConnectionController.php');

    class LoginController{
        private $server;

        /**
         * When instance has been created then the class get the connection.
         */
        function __construct(){
            $server = new ConnectionController();
            $this->server = $server->getConnection();
            unset($server);
        }

        function authentication(){

        }

        function googleAuthentication(){

        }

        /**
         * When the class isn't used anymore the connection will be closed.
         */
        function __destruct(){
            $this->server->close();
        }
    }