<?php
/**
 * Created by PhpStorm.
 * User: Christiaan
 * Date: 11-6-2015
 * Time: 13:12
 */
   include_once('ConnectionController.php');


   class DistrictController {
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
       function getDistrictList () {
            $query = "SELECT * FROM vw_DistrictList";
           $districtList = array();

           if($result = $this->connection->query($query)){
               foreach($result as $district){
                   $districtList[] = $district;
               }
           }

           return $districtList;
       }

       function getDistrict ($id) {
           $query = "SELECT * FROM vw_DistrictList WHERE districtnumber = $id";
           if($result = $this->connection->query($query)) {
               return $result->fetch_array();
           }
       }

       /**
        * Stored procedure for creating a customer with address
        * @param $customer an array of POST data
        * @return bool|mysqli_result
        */
       function createDistrict ($district){
           $query1 = "CALL sp_CreateDistrict('" . mysqli_real_escape_string($this->connection, $district['districtnaam']) . "')";

           if ($result = $this->connection->query($query1)) {
               if ($result) {
                   return 'success';
               }
           }
           return $this->connection->error;
       }

       function deleteDistrict($id) {
           $query = "CALL sp_DeleteDistrict(".mysqli_real_escape_string($this->connection,$id).")";
           if($result = $this->connection->query($query)){
               return $result;
           }
       }

       function changeDistrict ($district) {
           $query = "CALL sp_changeDistrict('" . mysqli_real_escape_string($this->connection, $district['districtnumber']) . "',
                                            '" . mysqli_real_escape_string($this->connection, $district['districtnaam']) . "')";

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