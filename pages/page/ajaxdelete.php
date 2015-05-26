<?php
    require_once('code/controllers/ConsignmentController.php');
    $consignmentController = new ConsignmentController();

    if(isset($_POST['consignmentnumber'])) {
        echo $result = $consignmentController->deleteConsignment($_POST['consignmentnumber']);
    }else{
        echo 'There is no consignmentnumber to delete.';
    }