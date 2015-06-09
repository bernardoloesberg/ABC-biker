<?php
    include_once('code/controllers/ConsignmentController.php');
    include_once('code/controllers/ParcelController.php');
    print_r($_SESSION['user']);
    if(isset($_GET['id']) && !empty($_GET['id'])){
        showMessage('succes', 'Welkom: '. $_SESSION['user']['employeefirstname'] . ' ' . $_SESSION['user']['employeelastname']);
    }

    $consignmentController = new ConsignmentController();
    $consignmentList = $consignmentController->getConsignmentsOfBiker($_SESSION['user']['employeenumber']);

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
    if(isset($c)) {
        foreach ($consignmentList as $consignment) {
            echo '<tr>
                     <td>' . $consignment['consignmentnumber'] . '</td>
                     <td>' . $consignment['customerfirstname'] . ' ' . $consignment['customerlastname'] . '</td>
                     <td>' . $consignment['pickupstreet'] . ' ' . $consignment['pickuphousenumber'] . '</td>
                     <td>' . $consignment['consignorname'] . '</td>
                     <td><a class="btn btn-info" href="' . $_SESSION['rooturl'] . '/consignmentdetail/' . $consignment['consignmentnumber'] . '">Bekijken</a></td>
                     <td><a class="btn btn-primary" href="' . $_SESSION['rooturl'] . '/consignmentchange/' . $consignment['consignmentnumber'] . '">Bewerken</a></td>
                     <td><button class="btn btn-danger deleteConsignment" value="' . $consignment['consignmentnumber'] . '">Verwijderen</button></td>
                 </tr>';
        }
    }else{
        echo '<tr><td></td></tr>';
    }

    echo                '</tbody>
                        </table>
                    </div>
              </div>';