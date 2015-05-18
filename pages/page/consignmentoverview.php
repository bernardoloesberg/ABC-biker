<?php
    include_once('code/controllers/ConsignmentController.php');

    $consignmentController = new ConsignmentController();
    $consignmentList = $consignmentController->getConsignmentList();

    //print_r($consignmentList);

    echo '<div class="row">
                <div class="col-md-4">

                </div>
                <div class="col-md-8">
                    <table class="table">
                        <thead>
                            <th>Consignmentnumber</th>
                            <th>Customer</th>
                            <th>Deliver street</th>
                            <th>Pickup street</th>
                            <th>Consignor</th>
                            <th>Bewerken</th>
                            <th>Verwijderen</th>
                        </thead>
                        <tbody>';

    foreach($consignmentList as $consignment){
        echo '<tr>
                 <td>'.$consignment['consignmentnumber'].'</td>
                 <td>'.$consignment['customerfirstname'] . ' ' . $consignment['customerlastname'].'</td>
                 <td>'.$consignment['deliverstreet']. ' ' . $consignment['deliverhousenumber'].'</td>
                 <td>'.$consignment['pickupstreet']. ' ' . $consignment['pickuphousenumber'].'</td>
                 <td>'.$consignment['consignorname'].'</td>
                 <td><a href="'.$_SESSION['rooturl'].'/consignmentchange/'.$consignment['consignmentnumber'].'">Bewerken</a></td>
                 <td><a href="'.$_SESSION['rooturl'].'/consignmentdelete/'.$consignment['consignmentnumber'].'">Verwijderen</a></td>
             </tr>';
    }

    echo                '</tbody>
                    </table>
                </div>
          </div>';