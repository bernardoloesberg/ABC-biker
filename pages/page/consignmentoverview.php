<?php
    include_once('code/controllers/ConsignmentController.php');
    include_once('code/controllers/ParcelController.php');

    $consignmentController = new ConsignmentController();
    $consignmentList = $consignmentController->getConsignmentList();

    if(isset($_POST['createParcel'])){
        $parcelController = new ParcelController();
        $result = $parcelController->createParcel($_POST);

        if($result == 'success'){
            showMessage('success','Er is een pakket toegevoegd aan de consignment.');
        }else{
            showMessage('success',$result);
        }
    }

    echo '<div class="row">
                <div class="col-md-2">

                </div>
                <div class="col-md-10">
                    <table class="table">
                        <thead>
                            <th>Consignmentnumber</th>
                            <th>Customer</th>
                            <th>Pickup street</th>
                            <th>Consignor</th>
                            <th>Bekijken</th>
                            <th>Bewerken</th>
                            <th>Verwijderen</th>
                        </thead>
                        <tbody>';

    foreach($consignmentList as $consignment){
        echo '<tr>
                 <td>'.$consignment['consignmentnumber'].'</td>
                 <td>'.$consignment['customerfirstname'] . ' ' . $consignment['customerlastname'].'</td>
                 <td>'.$consignment['pickupstreet']. ' ' . $consignment['pickuphousenumber'].'</td>
                 <td>'.$consignment['consignorname'].'</td>
                 <td><a class="btn btn-info" href="'.$_SESSION['rooturl'].'/consignmentdetail/'.$consignment['consignmentnumber'].'">Bekijken</a></td>
                 <td><a class="btn btn-primary" href="'.$_SESSION['rooturl'].'/consignmentchange/'.$consignment['consignmentnumber'].'">Bewerken</a></td>
                 <td><button class="btn btn-danger deleteConsignment" value="'.$consignment['consignmentnumber'].'">Verwijderen</button></td>
             </tr>';
    }

    echo                '</tbody>
                    </table>
                </div>
          </div>';

    loadscript('code/js/deleteHandlers.js');