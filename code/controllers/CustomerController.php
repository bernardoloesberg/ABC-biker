<?php
   include_once('ConnectionController.php');

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
          $query1 = "CALL sp_CreateCustomer('" . mysqli_real_escape_string($this->connection, $customer['customerlastname']) . "',
                                        '" . mysqli_real_escape_string($this->connection, $customer['customerfirstname']) . "',
                                        '" . mysqli_real_escape_string($this->connection, $customer['phonenumber']) . "',
                                        '" . mysqli_real_escape_string($this->connection, $customer['sex']) . "',
                                        '" . mysqli_real_escape_string($this->connection, $customer['companyname']) . "',
                                        '" . mysqli_real_escape_string($this->connection, $customer['email']) . "')";

          if ($result = $this->connection->query($query1)) {
              if ($result == 1) {
                  $query2 = "CALL sp_CreateAddress('" . mysqli_real_escape_string($this->connection, $customer['districtnumber']) . "',
                                        '" . mysqli_real_escape_string($this->connection, $customer['street']) . "',
                                        '" . mysqli_real_escape_string($this->connection, $customer['zipcode']) . "',
                                        '" . mysqli_real_escape_string($this->connection, $customer['housenumber']) . "',
                                        '" . mysqli_real_escape_string($this->connection, $customer['city']) . "',
                                        '" . mysqli_real_escape_string($this->connection, $customer['housenumberaddon']) . "')";

                  if ($result = $this->connection->query($query2)) {
                      if ($result == 1) {

                          $query3 = "SELECT addressnumber FROM address WHERE street = '" . mysqli_real_escape_string($this->connection, $customer['street']) . "' AND zipcode = '" . mysqli_real_escape_string($this->connection, $customer['zipcode']) . "' AND housenumber = '" . mysqli_real_escape_string($this->connection, $customer['housenumber']) . "'";
                          $query4 = "SELECT customernumber FROM customer WHERE customerlastname = '" . mysqli_real_escape_string($this->connection, $customer['customerlastname']) . "' AND customerfirstname = '" . mysqli_real_escape_string($this->connection, $customer['customerfirstname']) . "' AND phonenumber = '" . mysqli_real_escape_string($this->connection, $customer['phonenumber']) . "'";


                          if ($result = $this->connection->query($query4)) {
                              $customernumber = $result->fetch_array();
                          }

                          if ($result = $this->connection->query($query3)) {
                              $addressnumber = $result->fetch_array();
                          }

                          $query5 = "CALL sp_AddAddressToCustomer(" . $addressnumber[0] . "," . $customernumber[0] . ")";
                          /**
                           * End stage if this is TRUE then the entire procedure has passed
                           */
                          if ($result2 = $this->connection->query($query5)) {
                                return $result2;
                          }
                      }
                  }
              }
          }

          return $this->connection;
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
               return $result;
           }
       }

       /**
        * Get a address of a customer
        * @param $id
        * @return mixed
        */
       function getCustomerAddress($id){
           $query = "SELECT * FROM vw_getAddressFromCustomer WHERE customernumber =". mysqli_real_escape_string($this->connection, $id);

           if($result = $this->connection->query($query)){
               return $result->fetch_array();
           }
       }

      function __destruct(){
         $this->connection->close();
      }
   }