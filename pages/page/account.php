<?php
    include_once('code/controllers/ParcelController.php');

    /*If not logged in then send to login page*/
    if(!isset($_SESSION['user'])) loadpage($_SESSION['rooturl'].'/login');

    $parcelController = new ParcelController();

    /*When a user logged in a id comes with it. Then it says hello user*/
    if(isset($_GET['id']) && !empty($_GET['id']) && !empty($_SESSION['user']['employeenumber']) && $_SESSION['user']['rolename'] == 'dispatcher'  && !isset($_SESSION['abc-biker-token']) || isset($_GET['id']) && !empty($_GET['id']) && !empty($_SESSION['user']['employeenumber']) && $_SESSION['user']['rolename'] == 'manager'  && !isset($_SESSION['abc-biker-token'])){
        loadpage($_SESSION['rooturl']. '/authenticate');
    }

    /*When a user logged in a id comes with it. Then it says hello user*/
    if(isset($_GET['id']) && !empty($_GET['id']) && !empty($_SESSION['user']['employeenumber'])){
        showMessage('success', 'Welkom: '. $_SESSION['user']['employeefirstname'] . ' ' . $_SESSION['user']['employeelastname']);
    }

    /*When a user logged in a id comes with it. Then it says hello user*/
    if(isset($_GET['id']) && !empty($_GET['id']) && !empty($_SESSION['user']['customernumber'])){
        showMessage('success', 'Welkom: '. $_SESSION['user']['customerfirstname'] . ' ' . $_SESSION['user']['customerlastname']);
    }

    if(isset($_SESSION['user']['employeenumber'])){
        /*Get the parcels of the biker*/
        $parcelList = $parcelController->getParcelListOfBiker($_SESSION['user']['employeenumber']);


        echo '<div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Zendingnr</th>
                                    <th>Pakketnr</th>
                                    <th>Wordt opgehaald door</th>
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
    }elseif(isset($_SESSION['user']['customernumber'])){
        $consignmentController = new ConsignmentController();
        $consignmentList = $consignmentController->getCustomerConsignmentList($_SESSION['user']['employeenumber']);

        echo '<div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <th>Consignmentnumber</th>
                            <th>Customer</th>
                            <th>Pickup street</th>
                            <th>Consignor</th>
                            <th>Bekijken</th>
                        </thead>
                        <tbody>';

        foreach($consignmentList as $consignment){
            echo '<tr>
                 <td>'.$consignment['consignmentnumber'].'</td>
                 <td>'.$consignment['customerfirstname'] . ' ' . $consignment['customerlastname'].'</td>
                 <td>'.$consignment['pickupstreet']. ' ' . $consignment['pickuphousenumber'].'</td>
                 <td>'.$consignment['consignorname'].'</td>
                 <td><a class="btn btn-info" href="'.$_SESSION['rooturl'].'/consignmentdetail/'.$consignment['consignmentnumber'].'"><span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></a></td>
             </tr>';
        }

        echo                '</tbody>
                    </table>
                </div>
          </div>';
    }




