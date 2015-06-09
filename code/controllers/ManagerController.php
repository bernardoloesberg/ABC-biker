<?php
include_once('ConnectionController.php');
/**
 * Created by PhpStorm.
 * User: Christiaan
 * Date: 9-6-2015
 * Time: 13:21
 */

class ManagerController{
    private $connection;

    /**
     * When instance has been created then the class get the connection.
     */
    function __construct(){
        $server = new ConnectionController();
        $this->connection = $server->getConnection();
        unset($server);
    }

    function getStatistieken(){
        $query ="Call vw_getConsignmentdata.sql";
    }

    function __destruct(){
        $this->connection->close();
    }
}