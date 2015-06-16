<?php
    require_once('code/controllers/ConsignmentController.php');
    require_once('code/controllers/CustomerController.php');
    require_once('code/controllers/EmployeeController.php');
    require_once('code/controllers/AddressController.php');
    require_once('code/controllers/ParcelController.php');
    require_once('code/controllers/AddressForCustomerController.php');
    require_once('code/controllers/CustomerContactController.php');
    require_once('code/controllers/DistrictController.php');

    $consignmentController = new ConsignmentController();
    $customerController = new CustomerController();
    $employeeController = new EmployeeController();
    $addressController = new AddressController();
    $parcelController = new ParcelController();
    $addressForCustomerController = new AddressForCustomerController();
    $customerContactController = new CustomerContactController();
    $districtController = new DistrictController();

    if(isset($_POST['consignmentnumber'])) {
        echo $result = $consignmentController->deleteConsignment($_POST['consignmentnumber']);
    }

    if(isset($_POST['contactnumber'])){
        echo $customerContactController->deleteCustomerContact($_POST['contactnumber']);
    }

    if(isset($_POST['parcelnumber'])) {
        echo $parcelController->deleteParcel($_POST['parcelnumber']);
    }

    if(isset($_POST['customernumber'])) {
        echo $result = $customerController->deleteCustomer($_POST['customernumber']);
    }

    if(isset($_POST['employeenumber'])) {
        echo $result = $employeeController->deleteEmployee($_POST['employeenumber']);
    }

    if(isset($_POST['addressnumber'])) {
        echo $_POST['addressnumber'];
        echo $result = $addressController->deleteAddress($_POST['addressnumber']);
        echo $result;
    }

    if(isset($_POST['districtnumber'])) {
        echo $result = $districtController->deleteDistrict($_POST['districtnumber']);
    }

    if(isset($_POST['address']) && isset($_POST['customer'])) {
        echo json_encode($addressForCustomerController->deleteAddressFromCustomer($_POST['address'],$_POST['customer']));
    }