<?php
/**
 * Created by PhpStorm.
 * User: Christiaan
 * Date: 28-5-2015
 * Time: 14:33
 */
include_once('code/controllers/ConnectionController.php');
include_once('code/controllers/AddressController.php');

$connectionController = new ConnectionController();
$addressController = new AddressController();

if(isset($_POST['changeAddress'])){
    $result = $addressController->changeAddress($_POST);

    print_r($result);

    if($result){
        showMessage('success', 'Het adres is bijgewerkt!');
    }else{
        showMessage('danger', 'Het adres kon niet worden bijgewerkt!');
    }
}

echo '<div class="row">
            <div class="col-md-4">
                Menu
            </div>
            <div class="col-md-8">';

            if (isset($_GET['id'])) {
                $address = $addressController->getAddress($_GET['id']);
                $districts = $addressController->getDistricts();

                echo '
                    <form action="#" method="post">
                        <div class="form-group">
                            <label for="districtname">Districtname</label>
                            <select class="form-control" id= "districtname" name="districtname">
                            <option>'.$address['districtname'].'</option>';

                    foreach($districts as $district){
                        if($district['districtname'] != $address['districtname']){
                            echo '<option>'.$district['districtname'].'</option>';
                        }
                    }
 echo '
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="straat">Straat</label>
                            <input type="text" class="form-control" id="street" name="street" value="'.$address['street'].'">
                          </div>
                           <div class="form-group">
                            <label for="Plaats">Plaats</label>
                                <input type="text" class="form-control" id="city" name="city" value="'.$address['city'].'">
                          </div>
                          <div class="form-group">
                            <label for="Huisnummer">Huisnummer</label>
                            <input type="text" class="form-control" value="'.$address['housenumber'].'" disabled>
                            <input type="hidden" class="form-control" id="housenumber" name="housenumber" value="'.$address['housenumber'].'">
                          </div>
                          <div class="form-group">
                            <label for="Toevoeging">Toevoeging</label>
                            <input type="text" class="form-control" value="'.$address['housenumberaddon'].'" disabled>
                            <input type="hidden" class="form-control" id="housenumberaddon" name="housenumberaddon" value="'.$address['housenumberaddon'].'">
                          </div>
                          <div class="form-group">
                            <label for="Postcode">Postcode</label>
                            <input type="text" class="form-control" value="'.$address['zipcode'].'" disabled>
                            <input type="hidden" class="form-control" id="zipcode" name="zipcode" value="'.$address['zipcode'].'">
                          </div>
                          <button type="submit" class="btn btn-success" name="changeAddress">Sla verandering op</button>
                        </form>';
            }
            else{
                echo 'Geen nummer meegegeven';
            }
            echo'

                    </div>
          </div>';