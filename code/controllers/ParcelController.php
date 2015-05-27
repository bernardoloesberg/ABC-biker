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
         * Get a single parcel.
         * @param $id
         */
        function getParcel($id){
            $query = 'SELECT * FROM vw_getParcelList WHERE parcelnumber = '. mysqli_real_escape_string($this->connection,$id);
        }

        /**
         * Create a parcel.
         * @param $parcel
         */
        function createParcel($parcel){

        }

        /**
         * Update a parcel.
         * @param $parcel
         */
        function changeParcel($parcel){

        }

        /**
         * Delete a parcel.
         * @param $id
         */
        function deleteParcel($id){

        }

        /**
         * Close the database connection when it isnt in use anymore.
         */
        function __destruct(){
            $this->connection->close();
        }
    }