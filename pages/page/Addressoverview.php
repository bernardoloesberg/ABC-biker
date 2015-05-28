<?php
/**
 * Created by PhpStorm.
 * User: Christiaan
 * Date: 28-5-2015
 * Time: 15:29
 */

include_once('code/controllers/AddressController.php');

$addressController = new AddressController();
$addressList = $addressController->getAddressDistrictList();

//print_r($addressList);

echo '<div class="row">
                <div class="col-md-4">

                </div>
                <div class="col-md-8">
                    <div class="input-group"> <span class="input-group-addon">Filter</span>
                         <input id="filter" type="text" class="form-control" placeholder="Type here...">
                    </div>
                    <table class="table">
                        <thead>
                            <th>Postcode</th>
                            <th>Huisnummer</th>
                            <th>District</th>
                            <th>Bekijken</th>
                            <th>Bewerken</th>
                            <th>Verwijderen</th>
                        </thead>
                        <tbody class="searchable">';

foreach($addressList as $address){
    echo '<tr>
                 <td>'.$address['zipcode'].'</td>
                 <td>'.$address['housenumber'].' '.$address['housenumberaddon'].'</td>
                 <td>'.$address['districtname']. '</td>
                 <td><a class="btn btn-info" href="'.$_SESSION['rooturl'].'/addressdetails/'.$address['addressnumber'].'">Bekijken</a></td>
                 <td><a class="btn btn-primary" href="'.$_SESSION['rooturl'].'/addresschange/'.$address['addressnumber'].'">Bewerken</a></td>
                <td><button class="btn btn-danger deleteAddress" name="deleteAddress" value="'.$address['addressnumber'].'">Verwijderen</button></td>
             </tr>';
}

echo                '</tbody>
                    </table>
                </div>
          </div>';

loadscript('code/js/filter.js');
