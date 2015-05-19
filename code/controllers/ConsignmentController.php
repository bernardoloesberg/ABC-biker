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
         $query = "SELECT * FROM vw_getconsignmentlist WHERE consignmentnumber = " . mysqli_real_escape_string($this->connection,$consignmentnumber);
         $consignment = array();

         if($result = $this->connection->query($query)){
            $consignment = $result->fetch_assoc();
         }

         return $consignment;
      }

      /**
        * Delete a consignment.
        */
      function deleteConsignment($consignmentnumber){
         $query = "CALL sp_DeleteConsignment(".mysqli_real_escape_string($this->connection,$consignmentnumber).")";

         if($result = $this->connection->query($query)){
            return $result;
         }
      }

      /**
        * Create a consignment.
        */
      function createConsignment($consignment){
         $query = "CALL sp_CreateConsignment(".mysqli_real_escape_string($this->connection,$consignment['customernumber']).",
                                                      '".mysqli_real_escape_string($this->connection,$consignment['deliverstreet'])."',
                                                      '".mysqli_real_escape_string($this->connection,$consignment['deliverhousenumber'])."',
                                                      '".mysqli_real_escape_string($this->connection,$consignment['deliverzipcode'])."',
                                                      '".mysqli_real_escape_string($this->connection,$consignment['delivercity'])."',
                                                      '".mysqli_real_escape_string($this->connection,$consignment['deliverhousenumberaddon'])."',
                                                      '".mysqli_real_escape_string($this->connection,$consignment['pickupstreet'])."',
                                                      '".mysqli_real_escape_string($this->connection,$consignment['pickuphousenumber'])."',
                                                      '".mysqli_real_escape_string($this->connection,$consignment['pickupzipcode'])."',
                                                      '".mysqli_real_escape_string($this->connection,$consignment['pickupcity'])."',
                                                      '".mysqli_real_escape_string($this->connection,$consignment['pickuphousenumberaddon'])."',
                                                      '".mysqli_real_escape_string($this->connection,$consignment['consignorname'])."');";

         if($result = $this->connection->query($query)){
            return $result;
         }
      }

      /**
         * When the class isn't used anymore the connection will be closed.
         */
      function __destruct(){
         $this->connection->close();
      }
   }