<?php
   include_once('ConnectionController.php');
   include_once('AddressForCustomerController.php');

   /**
     * Class CustomerController
     * Author: Tom Kooiman
     */
   class CustomerController {
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
              return $result->fetch_array();
          }
      }

       /**
        * Stored procedure for creating a customer with address
        * @param $customer an array of POST data
        * @return bool|mysqli_result
        */
      function createCustomer ($customer){
          $AddressForCustomerController = new AddressForCustomerController();

          $query1 = "CALL sp_CreateCustomer('" . mysqli_real_escape_string($this->connection, $customer['customerlastname']) . "',
                                        '" . mysqli_real_escape_string($this->connection, $customer['customerfirstname']) . "',
                                        '" . mysqli_real_escape_string($this->connection, $customer['phonenumber']) . "',
                                        '" . mysqli_real_escape_string($this->connection, $customer['sex']) . "',
                                        '" . mysqli_real_escape_string($this->connection, $customer['companyname']) . "',
                                        '" . mysqli_real_escape_string($this->connection, $customer['email']) . "')";

          if ($result = $this->connection->query($query1)) {
              if ($result == 1) {
                  $result2 = $AddressForCustomerController->addAddressToCustomer($customer);

                  if($result2 == 'success') {
                      return 'success';
                  }
              }
          }
          return $this->connection->error;
      }

       function deleteCustomer($id) {
           $query = "CALL sp_deleteCustomer(".mysqli_real_escape_string($this->connection,$id).")";
            echo $query;

           if($result = $this->connection->query($query)){
               return $result;
           }
       }

       function changeCustomer ($customer) {
           $query = "CALL sp_changeCustomer('" . mysqli_real_escape_string($this->connection, $customer['customernumber']) . "',
                                            '" . mysqli_real_escape_string($this->connection, $customer['customerlastname']) . "',
                                            '" . mysqli_real_escape_string($this->connection, $customer['customerfirstname']) . "',
                                            '" . mysqli_real_escape_string($this->connection, $customer['phonenumber']) . "',
                                            '" . mysqli_real_escape_string($this->connection, $customer['sex']) . "',
                                            '" . mysqli_real_escape_string($this->connection, $customer['companyname']) . "',
                                            '" . mysqli_real_escape_string($this->connection, $customer['email']) . "')";

           if($result = $this->connection->query($query)){
               return 'success';
           }
           return $this->connection->error;
       }

       /**
        * Get a address of a customer
        * @param $id
        * @return mixed
        */

      function __destruct(){
         $this->connection->close();
      }
   }