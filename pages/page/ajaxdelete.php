<?php
    require_once('code/controllers/ConsignmentController.php');
    require_once('code/controllers/CustomerController.php');
    require_once('code/controllers/EmployeeController.php');
    require_once('code/controllers/AddressController.php');
    require_once('code/controllers/ParcelController.php');
    require_once('code/controllers/AddressForCustomerController.php');

    $consignmentController = new ConsignmentController();
    $customerController = new CustomerController();
    $employeeController = new EmployeeController();
    $addressController = new AddressController();
    $parcelController = new ParcelController();
    $addressForCustomerController = new AddressForCustomerController();

    if(isset($_POST['parcelnumber'])) {
        echo $parcelController->deleteParcel($_POST['parcelnumber']);
    } else {
        echo 'There is no parcelnumber to delete.';
    }

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
        echo 'There is no employeenumber to delete.';
    }

    if(isset($_POST['addressnumber'])) {
        echo $result = $addressController->deleteAddress($_POST['addressnumber']);
    } else {
        echo 'There is no addressnumber to delete.';
    }

    if(isset($_POST['address']) && isset($_POST['customer'])) {
        echo json_encode($addressForCustomerController->deleteAddressFromCustomer($_POST['address'],$_POST['customer']));
    } else {
        echo 'there is no address for customer to delete';
    }