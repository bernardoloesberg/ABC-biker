<?php
    require_once('code/controllers/ConsignmentController.php');
    require_once('code/controllers/CustomerController.php');
    require_once('code/controllers/EmployeeController.php');

    $consignmentController = new ConsignmentController();
    $customerController = new CustomerController();
    $employeeController = new EmployeeController();

    if(isset($_POST['consignmentnumber'])) {
        echo $result = $consignmentController->deleteConsignment($_POST['consignmentnumber']);
    }else{
        echo 'There is no consignmentnumber to delete.';
    }

    if(isset($_POST['customernumber'])) {
        echo $result = $customerController->deleteCustomer($_POST['customernumber']);
    } else {
        echo 'There is no customernumber to delete.';
    }

    if(isset($_POST['employeenumber'])) {
        echo $result = $employeeController->deleteEmployee($_POST['employeenumber']);
    } else {
        echo 'There is no employee to delete.';
    }