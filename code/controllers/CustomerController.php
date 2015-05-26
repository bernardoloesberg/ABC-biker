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

       /**
        * returns a specific customer on the customernumber
        * @param $id
        * @return bool|mysqli_result
        */
      function getCustomer ($id) {
          $query = "SELECT * FROM vw_CustomerList WHERE customernumber = $id";

          if($result = $this->connection->query($query)) {
              return $result;
          }
      }

       /**
        * Stored procedure for creating a customer with address
        * @param $customer an array of POST data
        * @return bool|mysqli_result
        */
      function createCustomer ($customer) {
           $query1 = "CALL sp_CreateCustomer('".mysqli_real_escape_string($this->connection,$customer['lastname'])."',
                                            '".mysqli_real_escape_string($this->connection,$customer['firstname'])."',
                                            '".mysqli_real_escape_string($this->connection,$customer['phonenumber'])."',
                                            '".mysqli_real_escape_string($this->connection,$customer['sex'])."',
                                            '".mysqli_real_escape_string($this->connection,$customer['companyname'])."',
                                            '".mysqli_real_escape_string($this->connection,$customer['email'])."')";
            echo $query1;
           if($result = $this->connection->query($query1)) {
                if($result == 1) {
                    $query2 = "CALL sp_CreateAddress('".mysqli_real_escape_string($this->connection,$customer['districtnumber'])."',
                                            '".mysqli_real_escape_string($this->connection,$customer['street'])."',
                                            '".mysqli_real_escape_string($this->connection,$customer['zipcode'])."',
                                            '".mysqli_real_escape_string($this->connection,$customer['housenumber'])."',
                                            '".mysqli_real_escape_string($this->connection,$customer['city'])."',
                                            '".mysqli_real_escape_string($this->connection,$customer['housenumberaddon'])."')";
                    echo $query2;

                    if($result = $this->connection->query($query2)) {
                        if($result == 1) {
                            $query3 = "SELECT addressnumber FROM address WHERE street = '".mysqli_real_escape_string($this->connection,$customer['street'])."' AND zipcode = '".mysqli_real_escape_string($this->connection,$customer['zipcode'])."' AND housenumber = '".mysqli_real_escape_string($this->connection,$customer['housenumber'])."'";
                            $query4 = "SELECT customernumber FROM customer WHERE customerlastname = '".mysqli_real_escape_string($this->connection,$customer['lastname'])."' AND customerfirstname = '".mysqli_real_escape_string($this->connection,$customer['firstname'])."' AND phonenumber = '".mysqli_real_escape_string($this->connection,$customer['phonenumber'])."'";

                            echo $query3;
                            echo $query4;

                            if($result = $this->connection->query($query3)) {
                                $customernumber = $result->fetch_assoc();

                                    print_r($customernumber);

                                //echo $customernumber;
                            }

                            if($result = $this->connection->query($query4)) {
                                $addressnumber = $result->fetch_assoc();
                                    print_r($addressnumber);

                                //echo $addressnumber;
                            }

                            $query5 = "CALL sp_AddAddressToCustomer(".$addressnumber['addressnumber'].",".$customernumber['customernumber'].")";
                            echo $query5;

                            if($result = $this->connection->query($query5)) {
                                echo $result;
                                echo 'YEAAY';
                            }
                        }
                    }
                }
           }
      }

      function __destruct(){
         $this->connection->close();
      }
   }