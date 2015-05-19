<?php
    include_once('ConnectionController.php');

    class ParcelController{
        private $connection;

        function __construct(){
            $server = new ConnectionController();
            $this->connection = $server->getConnection();
            unset($server);
        }



        function getParcelList(){
            $query = 'SELECT * FROM vw_ParcelList';
            $parcelList = array();

            if($result = $this->connection->query($query)){
                foreach($result as $parcel){
                    $parcelList[] = $parcel;
                }
            }

            return $parcelList;
        }

        function getParcel($id){
            $query = 'SELECT * FROM vw_ParcelList WHERE id = '. mysqli_real_escape_string($this->connection,$id);
        }

        function __destruct(){
            $this->connection->close();
        }
    }