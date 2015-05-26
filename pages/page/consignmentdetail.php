<?php
    /**
     * Created by PhpStorm.
     * User: Bernardo
     */
    include_once('code/controllers/ConsignmentController.php');
    include_once('code/controllers/CustomerController.php');
    include_once('code/controllers/ParcelController.php');

    $consignmentController = new ConsignmentController();
    $customerController = new CustomerController();
    $parcelController = new ParcelController();

    if(isset($_GET['id'])) {
        $customers = $customerController->getCustomerList();
        $consignment = $consignmentController->getConsignment($_GET['id']);

        echo '<div class="row">
            <div class="col-md-2">
                Menu
            </div>
            <div class="col-md-10">
                <table class="table">
                    <thead>
                        <tr><td><strong>Consignmentgegevens</strong></td>
                            <td></td></tr>
                    </thead>
                    <tbody>
                        <tr><td>Consignmentnumber</td>
                            <td>'.$consignment['consignmentnumber'].'</td>
                            <td>Klant voornaam</td>
                            <td>'.$consignment['customerfirstname'].'</td>
                            <td>Klant achternaam</td>
                            <td>'.$consignment['customerlastname'].'</td></tr>
                        <tr><td>Straat</td>
                            <td>'.$consignment['pickupstreet'].'</td>
                            <td>Huisnummer</td>
                            <td>'.$consignment['pickuphousenumber'].'</td>
                            <td>Postcode</td>
                            <td>'.$consignment['pickupzipcode'].'</td></tr>
                        <tr><td>Stad</td>
                            <td>'.$consignment['pickupcity'].'</td>
                            <td>Getekend door</td>
                            <td>'.$consignment['consignorname'].'</td>
                            <td>Afgerond</td>
                            <td>'.($consignment['completed'] == 1 ? 'Ja' : 'Nee').'</td></tr>
                        <tr><td>Ophaaltijd</td>
                            <td>'.$consignment['scheduledpickup'].'</td>
                            <td>Aflevertijd</td>
                            <td>'.$consignment['scheduleddelivery'].'</td>
                            <td>price</td>
                            <td>'.$consignment['price'] .'</td></tr>
                        <tr><td>Totaalprijs</td>
                            <td>'.$consignment['totalprice'].'</td>
                            <td></td>
                            <td></td></tr>
                    </tbody>
                </table>
            </div>
          </div>';

        $parcelList = $parcelController->getParcelList($_GET['id']);

        echo '<div class="row">
                <div class="col-md-2">

                </div>
                <div class="col-md-10">
                    <table class="table">
                        <thead>
                            <tr>
                                <td colspan="7"><a class="btn btn-primary" href="'.$_SESSION['rooturl'].'/parcelcreate">Nieuw pakket</a></td>
                            </tr>
                            <tr>
                                <th>Zendingnr</th>
                                <th>Pakketnr</th>
                                <th>Klant</th>
                                <th>Opgehaald</th>
                                <th>Geleverd</th>
                                <th>Bekijken</th>
                                <th>Bewerken</th>
                                <th>Verwijderen</th>
                            </tr>
                        </thead>
                        <tbody>';
        if(isset($parcelList)) {
            foreach ($parcelList as $parcel) {
                echo '<tr>
                 <td>' . $parcel['consignmentnumber'] . '</td>
                 <td>' . $parcel['parcelnumber'] . '</td>
                 <td>' . $parcel['addressnumber'] .'</td>
                 <td>' . $parcel['pickupemployeenumber'] . '</td>
                 <td>' . $parcel['deliveremployeenumber'] . '</td>
                 <td><a class="btn btn-primary" href="' . $_SESSION['rooturl'] . '/parceldetail/' . $parcel['parcelnumber'] . '">Bekijken</a></td>
                 <td><a class="btn btn-primary" href="' . $_SESSION['rooturl'] . '/parcelchange/' . $parcel['parcelnumber'] . '">Bewerken</a></td>
                 <td><button class="btn btn-danger deleteParcel" value="' . $parcel['parcelnumber'] . '">Verwijderen</button></td>
             </tr>';
            }
        }else{
            echo '<tr><td colspan="7">Er zijn geen pakketen!</td></tr>';
        }

        echo                '</tbody>
                    </table>
                </div>
          </div>';
    }else{
        echo 'Er is geen consignment nummer opgegeven';
    }