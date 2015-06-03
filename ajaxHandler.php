<?php
    /**
     * @author: Bernardo Loesberg
     */
    require_once('code/controllers/CustomerController.php');
    require_once('code/controllers/ParcelController.php');
    require_once('code/controllers/AddressForCustomerController.php');

    $customerController = new CustomerController();
    $parcelController = new ParcelController();
    $addressForCustomerController = new AddressForCustomerController();

    if(isset($_POST['customernumber'])){
        $customer = $customerController->getCustomer($_POST['customernumber']);
        echo json_encode($customer);
    }

    if(isset($_POST['customernumberforaddress'])) {
        echo json_encode($addressForCustomerController->getCustomerAddress($_POST['customernumberforaddress']));
    }

    if(isset($_POST['parcelnumber'])) {
        echo json_encode($parcelController->deleteParcel($_POST['parcelnumber']));
    }