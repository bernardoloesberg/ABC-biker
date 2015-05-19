<?php
include_once('ConnectionController.php');

/**
 * Class EmployeeController
 * Author: Christiaan ten Voorde
 */
class EmployeeController{
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
     * Get employeelist.
     */
    function getEmployeeList(){
        $query = "SELECT employeenumber, employeelastname, employeefirstname, bsn, cellphone FROM vw_getEmployeelist";
        $employeeList = array();

        if($result = $this->connection->query($query)){
            foreach($result as $consignment){
                $employeeList[] = $consignment;
            }
        }

        return $employeeList;
    }

    /**
     * Get a single consignment by a employeenumber.
     */
    function getEmployee($employeenumber){
        $query = "SELECT * FROM vw_getemployeelist WHERE employeenumber = " . mysqli_real_escape_string($this->connection, $employeenumber);
        $employee = array();

        if($result = $this->connection->query($query)){
            $employee = $result->fetch_assoc();
        }

        return $employee;
    }

    /**
     * Create an employee.
     */
    function createEmployee(){
            $query = "sp_CreateEmployee(0, 'Dorpsstraat', '3927BB', 43, 'Renswoude, 'A' , 'Ten Voorde', 'Christiaan', 012345678, 0612345678, 29-12-1989, 'M')";
            $this->connection->query($query);
        echo "hier ook";
    }

    /**
     * When the class isn't used anymore the connection will be closed.
     */
    function __destruct(){
        $this->connection->close();
    }
}