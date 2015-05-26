<?php
    require_once('ConsignmentController.php');
    $consignmentController = new ConsignmentController();

    if(isset($_GET['function']) && ($_GET['function'] == 'removeConsignment')){
        if(isset($_POST['consignmentnumber'])) {
            $result = $consignmentController->deleteConsignment($_POST['consignmentnumber']);
        }else{
            echo 'There is no consignmentnumber to delete.';
        }
    }