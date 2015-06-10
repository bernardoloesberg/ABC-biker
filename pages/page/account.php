<?php
    include_once('code/controllers/ParcelController.php');

    /*If not logged in then send to login page*/
    if(!isset($_SESSION['user'])) loadpage($_SESSION['rooturl'].'/login');

    $parcelController = new ParcelController();

    /*When a user logged in a id comes with it. Then it says hello user*/
    if(isset($_GET['id']) && !empty($_GET['id']) && !empty($_SESSION['user']['employeenumber'])){
        showMessage('success', 'Welkom: '. $_SESSION['user']['employeefirstname'] . ' ' . $_SESSION['user']['employeelastname']);
    }

    /*Get the parcels of the biker*/
    $parcelList = $parcelController->getParcelListOfBiker($_SESSION['user']['employeenumber']);


    echo '<div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Zendingnr</th>
                                    <th>Pakketnr</th>
                                    <th>Wordt opgehaald doo</th>
                                    <th>Wordt geleverd door</th>
                                    <th>Bekijken</th>
                                </tr>
                            </thead>
                            <tbody>';
    /*Check if there are any parcels for the biker*/
    if(!empty($parcelList)) {
        foreach ($parcelList as $parcel) {
            echo '<tr>
                     <td>' . $parcel['consignmentnumber'] . '</td>
                     <td>' . $parcel['parcelnumber'] . '</td>
                     <td>' . $parcel['pickupemployeefirstname'] . ' '. $parcel['pickupemployeelastname'] .'</td>
                     <td>' . $parcel['deliveremployeefirstname'] . ' '. $parcel['deliveremployeelastname'] .'</td>
                     <td><a class="btn btn-primary" href="' . $_SESSION['rooturl'] . '/parceldetail/' . $parcel['parcelnumber'] . '">Bekijken</a></td>
                 </tr>';
        }
    }else{
        echo '<tr><td colspan="5">Er zijn geen pakketen!</td></tr>';
    }

    echo                '</tbody>
                        </table>
                    </div>
              </div>';


