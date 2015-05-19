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

       /**
        * Returns a full list of all the customers.
        * @return array
        */
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
              return $result;
          }
      }

       /**
        * Stored procedure for creating a customer.
        * @param $customerlastname
        * @param $customerfirstname
        * @param $phonenumber
        * @param $sex
        * @param $companyname
        * @param $contactlastname
        * @param $contactfirstname
        * @param $email
        * @return bool|mysqli_result
        */
      function createCustomer ($customerlastname, $customerfirstname, $phonenumber, $sex, $companyname, $contactlastname, $contactfirstname, $email) {
           $query = "CALL sp_CreateCustomer('$customerlastname','$customerfirstname','$phonenumber','$sex','$companyname','$contactlastname','$contactfirstname','$email')";
          echo $query;
           if($result = $this->connection->query($query)) {
               return $result;
           }
      }

      function __destruct(){
         $this->connection->close();
      }
   }