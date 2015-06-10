<?php
   include_once('ConnectionController.php');
   include_once('AddressForCustomerController.php');
   include_once('LoginController.php');
   include_once('mailController.php');

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
          $loginController = new LoginController();
          $mailController = new MailController();

          $query1 = "CALL sp_CreateCustomer('" . mysqli_real_escape_string($this->connection, $customer['customerlastname']) . "',
                                        '" . mysqli_real_escape_string($this->connection, $customer['customerfirstname']) . "',
                                        '" . mysqli_real_escape_string($this->connection, $customer['phonenumber']) . "',
                                        '" . mysqli_real_escape_string($this->connection, $customer['sex']) . "',
                                        '" . mysqli_real_escape_string($this->connection, $customer['companyname']) . "',
                                        '" . mysqli_real_escape_string($this->connection, $customer['email']) . "',
                                        '" .  $loginController->hashPassword($customer['pw']). "')";

          if ($result = $this->connection->query($query1)) {
              if ($result) {

                  $query3 = "SELECT customernumber FROM customer WHERE customerlastname = '" . mysqli_real_escape_string($this->connection, $customer['customerlastname']) . "' AND customerfirstname = '" . mysqli_real_escape_string($this->connection, $customer['customerfirstname']) . "' AND phonenumber = '" . mysqli_real_escape_string($this->connection, $customer['phonenumber']) . "'";
                  if($result3 = $this->connection->query($query3)) {
                      if ($result3) {
                          $result4 = $mailController->sendPasswordForNewCostumer($result3->fetch_array(),$customer['pw']);

                          if($result4 != 'success') {
                              return $result4;
                          }
                      }
                  }

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
           echo $query;

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