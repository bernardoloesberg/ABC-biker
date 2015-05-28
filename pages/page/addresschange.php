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
            <div class="col-md-8">
                <form action="#" method="post">
                        <div class="form-group">
                            <label for="districtname">Districtnummer</label>
                            <input type="text" class="form-control" id="districtname" name="districtname">
                          </div>
                          <div class="form-group">
                            <label for="straat">Straat</label>
                            <input type="text" class="form-control" id="street" name="street">
                          </div>
                          <div class="form-group">
                            <label for="Huisnummer">Huisnummer</label>
                            <input type="text" class="form-control" id="housenumber" name="housenumber">
                          </div>
                          <div class="form-group">
                            <label for="Toevoeging">Toevoeging</label>
                            <input type="text" class="form-control" id="housenumberaddon" name="housenumberaddon">
                          </div>
                          <div class="form-group">
                            <label for="Postcode">Postcode</label>
                            <input type="text" class="form-control" id="zipcode" name="zipcode">
                          </div>
                          <div class="form-group">
                            <label for="Plaats">Plaats</label>
                                <input type="text" class="form-control" id="city" name="city">
                          </div>
                          <button type="submit" class="btn btn-success" name="changeAddress">Sla verandering op</button>
                        </form>
                    </div>
          </div>';