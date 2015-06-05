<?php
/**
 * Created by Tom Kooiman
 */
include_once('code/controllers/AddressForCustomerController.php');
include_once('code/controllers/AddressController.php');


$addressForCustomerController = new AddressForCustomerController();
$addressController = new AddressController();

if(isset($_POST['createAddress'])){
    $result = $addressForCustomerController->addAddressToCustomer($_POST);

    print_r($result);

    if($result == 'success'){
        showMessage('success', 'Het adres is aangemaakt!');
    }else{
        showMessage('danger', $result);
    }
}

echo '<div class="row">
            <div class="col-md-4">
                Menu
            </div>
            <div class="col-md-8">';

            if (isset($_GET['id'])) {
                $districts = $addressController->getDistricts();

                echo '
                    <form action="#" method="post">
                    <input type="hidden" id="customernumber" name="customernumber" value="'.$_GET['id'].'">
                        <div class="form-group">
                            <div class="col-md-6">
                            <label for="districtnumber">Districtname</label>
                            <select class="form-control" id="districtnumber" name="districtnumber">';

                foreach($districts as $district){
                        echo '<option value="'.$district['districtnumber'].'">'.$district['districtname'].'</option>';
                    }
 echo '
                            </select>
                            </div>
                            <div class="col-md-6">
                                    <label for="street">Straat</label>
                                    <input type="text" class="form-control" id="street" name="street" value="">
                              </div>
                            </div>
                            <div class="form-group">
                                 <div class="col-md-6">
                                    <label for="city">Plaats</label>
                                    <input type="text" class="form-control" id="city" name="city" value="">
                                </div>
                                <div class="col-md-6">
                                    <label for="zipcode">Postcode</label>
                                    <input type="text" id="zipcode" name="zipcode" class="form-control" value="">
                                </div>
                            </div>
                          <div class="form-group">
                              <div class="col-md-6">
                                <label for="housenumber">Huisnummer</label>
                                <input type="number" id="housenumber" name="housenumber" class="form-control" value="">
                              </div>
                              <div class="col-md-6">
                                <label for="housenumberaddon">Toevoeging</label>
                                <input type="text" id="housenumberaddon" name="housenumberaddon" class="form-control" value="">
                              </div>
                          </div>
                          <button type="submit" class="btn btn-success" name="createAddress">adres aanmaken</button>
                        </form>';
            }
            else{
                echo 'Geen nummer meegegeven';
            }
            echo'

                    </div>
          </div>';