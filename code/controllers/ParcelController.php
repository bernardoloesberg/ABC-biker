<?php
    include_once('ConnectionController.php');

    /**
     * Class ParcelController
     * @author: Bernardo Loesberg
     */
    class ParcelController{
        private $connection;

        function __construct(){
            $server = new ConnectionController();
            $this->connection = $server->getConnection();
            unset($server);
        }


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

        function getParcel($id){
            $query = 'SELECT * FROM vw_getParcelList WHERE parcelnumber = '. mysqli_real_escape_string($this->connection,$id);
        }

        function __destruct(){
            $this->connection->close();
        }
    }