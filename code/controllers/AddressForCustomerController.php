<?php
   include_once('ConnectionController.php');
   include_once('AddressController.php');

   /**
     * Class AddressForCustomerController
     * Author: Tom Kooiman
     */
   class AddressForCustomerController{
      private $connection;


      /**
        * When instance has been created then the class get the connection.
        */
      function __construct(){
         $server = new ConnectionController();
         $this->connection = $server->getConnection();
         unset($server);
      }

      function addAddressToCustomer($address) {
          $addressController = new AddressController();

          $result = $addressController->createAddress($address);
              if ($result) {

                  $query3 = "SELECT addressnumber FROM address WHERE street = '" . mysqli_real_escape_string($this->connection, $address['street']) . "' AND zipcode = '" . mysqli_real_escape_string($this->connection, $address['zipcode']) . "' AND housenumber = '" . mysqli_real_escape_string($this->connection, $address['housenumber']) . "'";

                  if ($result = $this->connection->query($query3)) {
                      $addressnumber = $result->fetch_array();
                  }

                  if(isset($address['customerlastname']) && $address['customerfirstname'] && $address['phonenumber']) {
                      $query4 = "SELECT customernumber FROM customer WHERE customerlastname = '" . mysqli_real_escape_string($this->connection, $address['customerlastname']) . "' AND customerfirstname = '" . mysqli_real_escape_string($this->connection, $address['customerfirstname']) . "' AND phonenumber = '" . mysqli_real_escape_string($this->connection, $address['phonenumber']) . "'";

                      if ($result = $this->connection->query($query4)) {
                          $customernumber = $result->fetch_array();
                      }

                      $query5 = "CALL sp_AddAddressToCustomer(" . $addressnumber[0] . "," . $customernumber[0] . ")";
                      /**
                       * End stage if this is TRUE then the entire procedure has passed
                       */

                      if ($result2 = $this->connection->query($query5)) {
                          if($result2) {
                              return 'success';
                          }
                      }
                  }

                  elseif (isset($address['customernumber'])) {
                      $query6 = "CALL sp_AddAddressToCustomer(" . $addressnumber[0] . "," . $address['customernumber'] . ")";

                      if ($result2 = $this->connection->query($query6)) {
                          if($result2) {
                              return 'success';
                          }
                      }
                  }
                  else {
                      echo 'geen geldige klant opgegeven!';
                  }


              }

          print_r($this->connection->error_list);

          return $this->connection->error;
      }

       function deleteAddressFromCustomer($address, $customer) {
           $query = "CALL sp_DeleteCustomerAddress(".$address.",".$customer.")";
           if ($result = $this->connection->query($query)) {
               if($result) {
                   return 'success';
               }
           }
           return $this->connection->error;
       }

       function getCustomerAddress($id){
           $query = "SELECT * FROM vw_getAddressFromCustomer WHERE customernumber =". mysqli_real_escape_string($this->connection, $id);

           if($result = $this->connection->query($query)){
               foreach($result as $customerAddress){
                   $customerAddressList[] = $customerAddress;
               }
               if(!empty($customerAddressList)) {
                   return $customerAddressList;
               } else {
                   return 0;
               }
           }
           return $this->connection->error;
       }

      function __destruct(){
         $this->connection->close();
      }
   }