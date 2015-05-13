<?php
   include_once('ConnectionController.php');

   class ConsignmentController{
      private $connection;

      function __construct(){
         $server = new ConnectionController();
         $this->connection = $server->getConnection();
         unset($server);
      }

      function getConsignmentList(){
         $query = "";
      }

      function __destruct(){
         $this->connection->close();
      }
   }