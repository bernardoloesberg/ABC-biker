<?php
    include_once('ConnectionController.php');

    /**
     * Class ParcelController
     * @author: Bernardo Loesberg
     */
    class ParcelController{
        private $connection;

        /**
         * When a instance is created it will connect to the database.
         */
        function __construct(){
            $server = new ConnectionController();
            $this->connection = $server->getConnection();
            unset($server);
        }

        /**
         * Get the parcel list
         * @param $id
         * @return array
         */
        function getParcelList($id){
            $query = 'SELECT * FROM vw_getParcelList WHERE consignmentnumber = '. mysqli_real_escape_string($this->connection,$id);
            $parcelList = array();

            if($result = $this->connection->query($query)){
                foreach($result as $parcel){
                    $parcelList[] = $parcel;
                }
            }

            return $parcelList;
        }

        /**
         * Get Parcel.
         * @param $id
         * @return array
         */
        function getParcel($id){
            $query = 'SELECT * FROM vw_getParcelList WHERE parcelnumber = '. mysqli_real_escape_string($this->connection,$id);

            $parcel = array();

            if($result = $this->connection->query($query)){
                $parcel = $result->fetch_assoc();
            }

            return $parcel;
        }

        /**
         * Create parcel
         * @param $parcel
         * @return bool|mysqli_result
         */
        function createParcel($parcel){
            $query = "CALL sp_createParcel(".mysqli_real_escape_string($this->connection,$parcel['consignmentnumber']).",
                                            ".mysqli_real_escape_string($this->connection,$parcel['pickupemployeenumber']).",
                                            ".mysqli_real_escape_string($this->connection,$parcel['deliveremployeenumber']).",
                                            '".mysqli_real_escape_string($this->connection,$parcel['pickupstreet'])."',
                                            '".mysqli_real_escape_string($this->connection,$parcel['pickupzipcode'])."',
                                            '".mysqli_real_escape_string($this->connection,$parcel['pickuphousenumber'])."',
                                            '".mysqli_real_escape_string($this->connection,$parcel['pickupcity'])."',
                                            '".mysqli_real_escape_string($this->connection,$parcel['pickuphousenumberaddon'])."',
                                            ".mysqli_real_escape_string($this->connection,$parcel['weigthingrams']).",
                                            '".mysqli_real_escape_string($this->connection,$parcel['pickup'])."',
                                            '".mysqli_real_escape_string($this->connection,$parcel['delivery'])."',
                                            '".mysqli_real_escape_string($this->connection,$parcel['hqarrival'])."',
                                            '".mysqli_real_escape_string($this->connection,$parcel['hqdeparture'])."',
                                            '".mysqli_real_escape_string($this->connection,$parcel['comment'])."',
                                            '".mysqli_real_escape_string($this->connection,$parcel['price'])."',
                                            ".(isset($parcel['express']) ? mysqli_real_escape_string($this->connection,$parcel['express']) : 0 ).")";
            echo $query;

            if($result = $this->connection->query($query)){
                return $result;
            }
        }

        /**
         * Update a parcel.
         * @param $parcel
         * @return bool|mysqli_result
         */
        function changeParcel($parcel){
            $query = "CALL sp_changeParcel(".mysqli_real_escape_string($this->connection,$parcel['parcelnumber']).",
                                            ".mysqli_real_escape_string($this->connection,$parcel['consignmentnumber']).",
                                            ".mysqli_real_escape_string($this->connection,$parcel['pickupemployeenumber']).",
                                            ".mysqli_real_escape_string($this->connection,$parcel['deliveremployeenumber']).",
                                            '".mysqli_real_escape_string($this->connection,$parcel['pickupstreet'])."',
                                            '".mysqli_real_escape_string($this->connection,$parcel['pickupzipcode'])."',
                                            '".mysqli_real_escape_string($this->connection,$parcel['pickuphousenumber'])."',
                                            '".mysqli_real_escape_string($this->connection,$parcel['pickupcity'])."',
                                            '".mysqli_real_escape_string($this->connection,$parcel['pickuphousenumberaddon'])."',
                                            '".mysqli_real_escape_string($this->connection,$parcel['weigthingrams'])."',
                                            '".mysqli_real_escape_string($this->connection,$parcel['pickup'])."',
                                            '".mysqli_real_escape_string($this->connection,$parcel['delivery'])."',
                                            '".mysqli_real_escape_string($this->connection,$parcel['hqarrival'])."',
                                            '".mysqli_real_escape_string($this->connection,$parcel['hqdeparture'])."',
                                            '".mysqli_real_escape_string($this->connection,$parcel['comment'])."',
                                            '".mysqli_real_escape_string($this->connection,$parcel['price'])."',
                                            ".(isset($parcel['express']) ? mysqli_real_escape_string($this->connection,$parcel['express']) : 0 ).")";
            echo $query;

            if($result = $this->connection->query($query)){
                return $result;
            }
        }

        /**
         * Delete a parcel.
         * @param $parcelnumber
         * @return bool|mysqli_result
         */
        function deleteParcel($parcelnumber){
            $query = "CALL sp_deleteParcel(".mysqli_real_escape_string($this->connection,$parcelnumber).")";

            if($result = $this->connection->query($query)){
                echo $query;
                return $result;
            }
        }

        /**
         * Close the database connection when it isnt in use anymore.
         */
        function __destruct(){
            $this->connection->close();
        }
    }