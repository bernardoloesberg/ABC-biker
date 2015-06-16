<?php
include_once('code/controllers/EmployeeController.php');
$employeeController = new EmployeeController();
$employee = $employeeController->checkActiveEmployee(1);

print_r($employee);

if($employee){
    echo"jaja";
}
