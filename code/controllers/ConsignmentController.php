<?php
    include_once('ConnectionController.php');

    /**
     * Class ConnectionController
     * @Author: Bernardo Loesberg
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
         * Get the consignment list.
         * @return array
         */
        function getConsignmentList(){
            $query = "SELECT * FROM vw_getConsignmentList";
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
         * @param $consignmentnumber
         * @return array
         */
        function getConsignment($consignmentnumber){
            $query = "SELECT * FROM vw_getConsignmentList WHERE consignmentnumber = " . mysqli_real_escape_string($this->connection,$consignmentnumber);
            $consignment = array();

            if($result = $this->connection->query($query)){
                $consignment = $result->fetch_assoc();
            }

            return $consignment;
        }

        /**
         * Delete consignment
         * @param $consignmentnumber
         * @return string
         */
        function deleteConsignment($consignmentnumber){
            $query = "CALL sp_deleteConsignment(".mysqli_real_escape_string($this->connection,$consignmentnumber).")";

            if($result = $this->connection->query($query)){
                return 'success';
            }else{
                return $this->connection->error;
            }
        }

        /**
         * Create Consignment
         * @param $consignment
         * @return string
         */
        function createConsignment($consignment){
            $query = "CALL sp_createConsignment(".mysqli_real_escape_string($this->connection,$consignment['customernumber']).",
                                                                '".mysqli_real_escape_string($this->connection,$consignment['pickupstreet'])."',
                                                                '".mysqli_real_escape_string($this->connection,$consignment['pickupzipcode'])."',
                                                                ".mysqli_real_escape_string($this->connection,$consignment['pickuphousenumber']).",
                                                                '".mysqli_real_escape_string($this->connection,$consignment['pickupcity'])."',
                                                                '".mysqli_real_escape_string($this->connection,$consignment['pickuphousenumberaddon'])."',
                                                                ".(!empty($consignment['consignorname'])? mysqli_real_escape_string($this->connection,$consignment['consignorname']) : 'null').",
                                                                0,
                                                                ".(!empty($consignment['scheduledpickup'])? mysqli_real_escape_string($this->connection,$consignment['scheduledpickup']) : 'null').",
                                                                ".(!empty($consignment['scheduleddelivery'])? mysqli_real_escape_string($this->connection,$consignment['scheduleddelivery']) : 'null').",
                                                                0,
                                                                '".mysqli_real_escape_string($this->connection,$consignment['totalprice'])."',
                                                                @p_consignmentnumber);";

            echo $query;

            if($result = $this->connection->query($query)){
                $result = $this->connection->query('SELECT @p_consignmentnumber');

                $id = 0;
                while($row = $result->fetch_row()){
                    $id = $row;
                }
                return $id[0];
            }else{
                return $this->connection->error;
            }
        }

        /**
         * Change the consignment
         * @param $consignment
         */
        function changeConsignment($consignment){
            $query = "CALL sp_changeConsignment(".mysqli_real_escape_string($this->connection,$consignment['consignmentnumber']).",
                                                        ".mysqli_real_escape_string($this->connection,$consignment['customernumber']).",
                                                        '".mysqli_real_escape_string($this->connection,$consignment['pickupstreet'])."',
                                                        '".mysqli_real_escape_string($this->connection,$consignment['pickupzipcode'])."',
                                                        ".mysqli_real_escape_string($this->connection,$consignment['pickuphousenumber']).",
                                                        '".mysqli_real_escape_string($this->connection,$consignment['pickupcity'])."',
                                                        '".mysqli_real_escape_string($this->connection,$consignment['pickuphousenumberaddon'])."',
                                                        '".mysqli_real_escape_string($this->connection,$consignment['consignorname'])."',
                                                        ".mysqli_real_escape_string($this->connection,$consignment['completed']).",
                                                        '".mysqli_real_escape_string($this->connection,$consignment['scheduledpickup'])."',
                                                        '".mysqli_real_escape_string($this->connection,$consignment['scheduleddelivery'])."',
                                                        '".mysqli_real_escape_string($this->connection,$consignment['price'])."',
                                                        '".mysqli_real_escape_string($this->connection,$consignment['totalprice'])."',
                                                        ".mysqli_real_escape_string($this->connection,1).",
                                                        '".mysqli_real_escape_string($this->connection,$consignment['comment'])."');";

            //echo $query;

            if($result = $this->connection->query($query)){
                return 'success';
            }else{
                return $this->connection->error;
            }
        }

        /**
         * When the class isn't used anymore the connection will be closed.
         */
        function __destruct(){
            $this->connection->close();
        }
    }