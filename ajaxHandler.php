<?php
    /**
     * @author: Bernardo Loesberg
     */
    require_once('code/controllers/CustomerController.php');
    require_once('code/controllers/AddressForCustomerController.php');

    $customerController = new CustomerController();
    $addressForCustomerController = new AddressForCustomerController();

    if(isset($_POST['customernumber'])){
        $customer = $customerController->getCustomer($_POST['customernumber']);
        echo json_encode($customer);
    }

    if(isset($_POST['customernumberforaddress'])) {
        header("Content-Type: application/json", true);
        echo json_encode($addressForCustomerController->getCustomerAddress($_POST['customernumberforaddress']));
    }