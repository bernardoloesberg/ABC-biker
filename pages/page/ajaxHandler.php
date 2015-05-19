<?php
    $consignmentController = new ConsignmentController();

    if(isset($_POST['action']) && isset($_POST['id']) && $_POST['action'] == 'deleteConsignment'){
        $consignmentController->deleteConsignment($_GET['id']);
    }