<?php
    require_once('code/controllers/ConsignmentController.php');
    require_once('code/controllers/CustomerController.php');

    $consignmentController = new ConsignmentController();
    $customerController = new CustomerController();

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