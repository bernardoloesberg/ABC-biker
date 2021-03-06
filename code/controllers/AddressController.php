<?php
   include_once('ConnectionController.php');

   /**
     * Class AddressController
     * Author: Tom Kooiman
     */
   class AddressController{
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
        * Returns a full list of all the addressees.
        * @return array
        */
      function getAddressList () {
          $query = "SELECT * FROM vw_CustomerList";
          $addressList = array();

          if($result = $this->connection->query($query)){
              foreach($result as $address){
                  $addressList[] = $address;
              }
          }
          return $addressList;
      }

       function getAddressDistrictList () {
           $query = "SELECT * FROM vw_AddressListDistrictName";
           $addressList = array();

           if($result = $this->connection->query($query)){
               foreach($result as $address){
                   $addressList[] = $address;
               }
           }
           return $addressList;
       }

       /**
        * get A specific address
        * @param $id
        * @return bool|mysqli_result
        */
      function getAddress ($id) {
          $query = "SELECT * FROM vw_AddressListDistrictName WHERE addressnumber = $id";

          $address = array();

          if($result = $this->connection->query($query)){
              $address = $result->fetch_assoc();
          }

          return $address;
      }

       function createAddress ($address) {
           $query = "CALL sp_CreateAddress(".mysqli_real_escape_string($this->connection,$address['districtnumber']).",
                                           '".mysqli_real_escape_string($this->connection,$address['street'])."',
                                           '".mysqli_real_escape_string($this->connection,$address['zipcode'])."',
                                           ".mysqli_real_escape_string($this->connection,$address['housenumber']).",
                                           '".mysqli_real_escape_string($this->connection,$address['city'])."',
                                           '".mysqli_real_escape_string($this->connection,$address['housenumberaddon'])."')";

           if($result = $this->connection->query($query)) {
               if($result) {
                   return 'success';
               }
           }
           return $this->connection->error;
       }

       function changeAddress ($address) {
           $query = "CALL sp_ChangeAddress('".mysqli_real_escape_string($this->connection,$address['districtname'])."',
                                           '".mysqli_real_escape_string($this->connection,$address['street'])."',
                                           '".mysqli_real_escape_string($this->connection,$address['zipcode'])."',
                                           ".mysqli_real_escape_string($this->connection,$address['housenumber']).",
                                           '".mysqli_real_escape_string($this->connection,$address['city'])."',
                                           '".mysqli_real_escape_string($this->connection,$address['housenumberaddon'])."')";

           if($result = $this->connection->query($query)) {
               return $result;
           }
       }

       function getDistricts () {
           $query = "SELECT * FROM vw_Districts";

           $districts = array();

           if($result = $this->connection->query($query)){
               foreach($result as $district){
                   $districts[] = $district;
               }
           }
           return $districts;
       }

       function deleteAddress($address){

           $query = "CALL sp_DeleteAddress(".mysqli_real_escape_string($this->connection,$address).")";
           if($result = $this->connection->query($query)){
               return $result;
           }
           else{
               return $this->connection->error;
           }
       }

      function __destruct(){
         $this->connection->close();
      }
   }