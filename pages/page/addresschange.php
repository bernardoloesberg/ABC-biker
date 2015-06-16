<?php
/**
 * Created by PhpStorm.
 * User: Christiaan
 * Date: 28-5-2015
 * Time: 14:33
 */
include_once('code/controllers/AddressController.php');

$addressController = new AddressController();

if(isset($_SESSION['user']) && $_SESSION['user']['rolename'] == 'dispatcher'){
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
            <div class="col-md-12">';

    if (isset($_GET['id'])) {
        $address = $addressController->getAddress($_GET['id']);
        $districts = $addressController->getDistricts();

        echo '
                    <form action="#" method="post">
                        <div class="form-group">
                            <div class="col-md-6">
                            <label for="districtname">District</label>
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
                            <div class="col-md-6">
                                    <label for="straat">Straat</label>
                                    <input type="text" class="form-control" id="street" name="street" value="'.$address['street'].'">
                              </div>
                            </div>
                            <div class="form-group">
                                 <div class="col-md-6">
                                    <label for="Plaats">Plaats</label>
                                    <input type="text" class="form-control" id="city" name="city" value="'.$address['city'].'">
                                </div>
                                <div class="col-md-6">
                                    <label for="Postcode">Postcode</label>
                                    <input type="text" class="form-control" value="'.$address['zipcode'].'" disabled>
                                    <input type="hidden" class="form-control" id="zipcode" name="zipcode" value="'.$address['zipcode'].'">
                                </div>
                            </div>
                          <div class="form-group">
                              <div class="col-md-6">
                                <label for="Huisnummer">Huisnummer</label>
                                <input type="text" class="form-control" value="'.$address['housenumber'].'" disabled>
                                <input type="hidden" class="form-control" id="housenumber" name="housenumber" value="'.$address['housenumber'].'">
                              </div>
                              <div class="col-md-6">
                                <label for="Toevoeging">Toevoeging</label>
                                <input type="text" class="form-control" value="'.$address['housenumberaddon'].'" disabled>
                                <input type="hidden" class="form-control" id="housenumberaddon" name="housenumberaddon" value="'.$address['housenumberaddon'].'">
                              </div>
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
}else{
    showMessage('danger', 'U heeft geen toegang tot deze pagina! Neem contact op met de beheerder.');
}