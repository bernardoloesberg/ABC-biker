<?php
   include_once('ConnectionController.php');

   /**
     * Class CustomerController
     * Author: Tom Kooiman
     */
   class CustomerController{
      private $connection;

      /**
        * When instance has been created then the class get the connection.
        */
      function __construct(){
         $server = new ConnectionController();
         $this->connection = $server->getConnection();
         unset($server);
      }

      function getCustomerList () {
          $query = "SELECT * FROM vw_CustomerList";
          $customerList = array();

          if($result = $this->connection->query($query)){
              foreach($result as $customer){
                  $customerList[] = $customer;
              }
          }

          return $customerList;
      }

      function getCustomer ($id) {
          $query = "SELECT * FROM vw_CustomerList WHERE customernumber = $id";

          if($result = $this->connection->query($query)) {
              print_r($result);
          }
      }

      function createCustomer ($customerlastname, $customerfirstname, $phonenumber, $sex, $companyname, $contactlastname, $contactfirstname, $email) {
           $query = "CALL sp_CreateCustomer( $customerlastname, $customerfirstname, $phonenumber, $sex, $companyname, $contactlastname, $contactfirstname, $email)";

           if($result = $this->connection->query($query)) {
               print_r($result);
           }
      }

      function __destruct(){
         $this->connection->close();
      }
   }