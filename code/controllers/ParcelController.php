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
         * Get the parcel list
         * @param $id
         * @return array
         */
        function getParcelListOfBiker($id){
            $query = 'SELECT * FROM vw_getParcelList WHERE pickupemployeenumber = '. mysqli_real_escape_string($this->connection,$id) .' OR deliveremployeenumber = ' . mysqli_real_escape_string($this->connection,$id);
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
                                            ".(!empty($parcel['pickup'])? mysqli_real_escape_string($this->connection,$parcel['pickup']) : 'null').",
                                            ".(!empty($parcel['delivery'])? mysqli_real_escape_string($this->connection,$parcel['delivery']) : 'null').",
                                            ".(!empty($parcel['hqarrival'])? mysqli_real_escape_string($this->connection,$parcel['hqarrival']) : 'null').",
                                            ".(!empty($parcel['hqdeparture'])? mysqli_real_escape_string($this->connection,$parcel['hqdeparture']) : 'null').",
                                            ".(!empty($parcel['comment'])? mysqli_real_escape_string($this->connection,$parcel['comment']) : 'null').",
                                            '".mysqli_real_escape_string($this->connection,$parcel['price'])."',
                                            ".(isset($parcel['express']) ? mysqli_real_escape_string($this->connection,$parcel['express']) : 0 ).")";
            echo $query;

            if($result = $this->connection->query($query)){
                return 'success';
            }else{
                return $this->connection->error;
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
                                            ".(!empty($parcel['pickup'])? mysqli_real_escape_string($this->connection,$parcel['pickup']) : 'null').",
                                            ".(!empty($parcel['delivery'])? mysqli_real_escape_string($this->connection,$parcel['delivery']) : 'null').",
                                            ".(!empty($parcel['hqarrival'])? mysqli_real_escape_string($this->connection,$parcel['hqarrival']) : 'null').",
                                            ".(!empty($parcel['hqdeparture'])? mysqli_real_escape_string($this->connection,$parcel['hqdeparture']) : 'null').",
                                            ".(!empty($parcel['comment'])? mysqli_real_escape_string($this->connection,$parcel['comment']) : 'null').",
                                            '".mysqli_real_escape_string($this->connection,$parcel['price'])."',
                                            ".(isset($parcel['express']) ? mysqli_real_escape_string($this->connection,$parcel['express']) : 0 ).")";
            echo $query;

            if($result = $this->connection->query($query)){
                return 'success';
            }else{
                return $this->connection->error;
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
                return 'success';
            }else{
                return $this->connection->error;
            }
        }

        function setPickupTime($id){
            $query = "CALL sp_biker_pickedup(".mysqli_real_escape_string($this->connection,$id).", ".mysqli_real_escape_string($this->connection,$_SESSION['user']['employeenumber']).")";
        }

        function setDeliverTime($id){
            $query = "CALL sp_biker_pickedup(".mysqli_real_escape_string($this->connection,$id).", ".mysqli_real_escape_string($this->connection,$_SESSION['user']['employeenumber']).")";
        }

        function setHqDepatureTime($id){
            $query = "CALL sp_biker_pickedup(".mysqli_real_escape_string($this->connection,$id).", ".mysqli_real_escape_string($this->connection,$_SESSION['user']['employeenumber']).")";
        }

        function setHqArrivalTime($id){
            $query = "CALL sp_biker_pickedup(".mysqli_real_escape_string($this->connection,$id).", ".mysqli_real_escape_string($this->connection,$_SESSION['user']['employeenumber']).")";
        }

        /**
         * Close the database connection when it isnt in use anymore.
         */
        function __destruct(){
            $this->connection->close();
        }
    }