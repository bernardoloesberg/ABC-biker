<?php
    /**
     * @author: Bernardo Loesberg
     */
    require_once('code/controllers/CustomerController.php');
    $customerController = new CustomerController();

    if(isset($_POST['customernumber'])){
        $customer = $customerController->getCustomer($_POST['customernumber']);
        echo json_encode($customer);
    }