<?php
   include_once('ConnectionController.php');

   /**
     * Class ConnectionController
     * Author: Bernardo Loesberg
     */
   class ConsignmentController{
      private $connection;

      /**
        * When instance has been created then the class get the connection.
        */
      function __construct(){
         $server = new ConnectionController();
         $this->connection = $server->getConnection();
         unset($server);
      }

      /**
        * Get consignmentlist.
        */
      function getConsignmentList(){
         $query = "SELECT * FROM vw_getconsignmentlist";
         $consignmentList = array();

         if($result = $this->connection->query($query)){
            foreach($result as $consignment){
               $consignmentList[] = $consignment;
            }
         }

         return $consignmentList;
      }

      /**
        * Get a single consignment by a consignmentnumber.
        */
      function getConsignment($consignmentnumber){
         $query = "SELECT * FROM vw_getconsignmentlist WHERE consignmentnumber = " . $consignmentnumber;
         $consignment = array();

         if($result = $this->connection->query($query)){
            $consignment = $result->fetch_assoc();
         }

         return $consignment;
      }

      /**
        * Create a consignment.
        */
      function createConsignment($consignment){

      }

      /**
         * When the class isn't used anymore the connection will be closed.
         */
      function __destruct(){
         $this->connection->close();
      }
   }