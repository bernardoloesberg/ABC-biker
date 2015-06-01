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

    function deleteEmployee($employee){
        $query = "CALL sp_DeleteEmployee(".mysqli_real_escape_string($this->connection,$employee['deleteEmployee']).")";
        if($result = $this->connection->query($query)){
            return $result;
        }
    }

    /**
     * Create an employee.
     */
    function createEmployee($employee){
        $query1 = "CALL sp_CreateEmployee(0,
                                    '".mysqli_real_escape_string($this->connection,$employee['street'])."',
                                    '".mysqli_real_escape_string($this->connection,$employee['zipcode'])."',
                                    ".mysqli_real_escape_string($this->connection,$employee['housenumber']).",
                                    '".mysqli_real_escape_string($this->connection,$employee['city'])."',
                                    '".mysqli_real_escape_string($this->connection,$employee['housenumberaddon'])."',
                                    '".mysqli_real_escape_string($this->connection,$employee['employeeFirstName'])."',
                                    '".mysqli_real_escape_string($this->connection,$employee['employeeLastName'])."',
                                    ".mysqli_real_escape_string($this->connection,$employee['bsn']).",
                                    '".mysqli_real_escape_string($this->connection,$employee['cellphone'])."',
                                    STR_TO_DATE('".mysqli_real_escape_string($this->connection,$employee['birthday']).",
                                    ".mysqli_real_escape_string($this->connection,$employee['birthmonth']).",
                                    ".mysqli_real_escape_string($this->connection,$employee['birthyear'])."' , '%d,%m,%Y'),
                                    '".mysqli_real_escape_string($this->connection,$employee['sex'])."',
                                    'Hallo');";
        if($result = $this->connection->query($query1)) {
            if ($result == 1) {
                $query2 = "SELECT employeenumber FROM vw_getemployeelist WHERE bsn = " . mysqli_real_escape_string($this->connection, $employee['bsn']);
                if($result = $this->connection->query($query2)) {
                    if ($result == 1) {
                        $employeenumber = $result->fetch_assoc();
                        $query3 = "Call sp_CreateRolesEmployee($employeenumber,
                            ".mysqli_real_escape_string($this->connection,$employee['biker']).",
                            '".mysqli_real_escape_string($this->connection,$employee['bus'])."',
                            '".mysqli_real_escape_string($this->connection,$employee['dispatcher'])."',);";
                    }
                }
            }
        }
    }

    function changeEmployee($employee){
        $query = "CALL sp_ChangeEmployee(".mysqli_real_escape_string($this->connection,$employee['employeenumber']).",
                                    0,
                                    '".mysqli_real_escape_string($this->connection,$employee['street'])."',
                                    '".mysqli_real_escape_string($this->connection,$employee['zipcode'])."',
                                    ".mysqli_real_escape_string($this->connection,$employee['housenumber']).",
                                    '".mysqli_real_escape_string($this->connection,$employee['city'])."',
                                    '".mysqli_real_escape_string($this->connection,$employee['housenumberaddon'])."',
                                    '".mysqli_real_escape_string($this->connection,$employee['employeeFirstName'])."',
                                    '".mysqli_real_escape_string($this->connection,$employee['employeeLastName'])."',
                                    ".mysqli_real_escape_string($this->connection,$employee['bsn']).",
                                    ".mysqli_real_escape_string($this->connection,$employee['cellphone']).",
                                    STR_TO_DATE('".mysqli_real_escape_string($this->connection,$employee['birthday']).",
                                    ".mysqli_real_escape_string($this->connection,$employee['birthmonth']).",
                                    ".mysqli_real_escape_string($this->connection,$employee['birthyear'])."' , '%d,%m,%Y'),
                                    '".mysqli_real_escape_string($this->connection,$employee['sex'])."');";
        echo $query;
        if($result = $this->connection->query($query)){
            return $result;
        }

    }

    /**
     * When the class isn't used anymore the connection will be closed.
     */
    function __destruct(){
        $this->connection->close();
    }
}