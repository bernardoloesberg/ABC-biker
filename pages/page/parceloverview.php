<?php
    include_once('../../code/controllers/ParcelController.php');

    $parcelController = new ParcelController();
    $parcelList = $parcelController->getParcelList();

    echo '<ul class="list-inline">';
    foreach($parcelList as $parcel){
        echo '<li>'.$parcel['trackingnumber'].' / '. $parcel[''].'</li>';
    }
    echo '</ul>';