<?php
    class ConnectionController{
        private $server     = 'localhost';
        private $database   = 'abcbiker';
        private $user       = 'root';
        private $password   = 'root';

        private $connection;

        function __construct(){
            $this->connection = new mysqli($this->server,$this->user,$this->password);
            $this->connection->select_db($this->database);

            $this->setLanguage('nl_NL');
        }

        function setLanguage($language){
            $query = "SET lc_times_name = '".$language."'";
            $this->connection->query($query);
        }

        function getConnection(){
            return $this->connection;
        }
    }