<?php
    include_once('code/controllers/CustomerController.php');
    include_once('code/controllers/AddressController.php');
    include_once('code/controllers/LoginController.php');

    $customerController = new CustomerController();
    $addressController = new AddressController();
    $loginController = new LoginController();

    if(isset($_POST['submit'])){
        $result = $customerController->createCustomer($_POST);
        if($result == 'success' && $_POST['city'] != 'Arnhem') {
            showMessage('warning', 'Uw woonplaats is niet in Arnhem. De klant is wel aangemaakt, maar normaliter bezorgen wij alleen in Arnhem!');
        } elseif($result == 'success') {
            showMessage('success','De klant is succesvol aangemaakt! Een email met het wachtwoord is gestuurd! ');
        } else {
            showMessage('danger',$result);
        }
    }

    $districts = $addressController->getDistricts();



    echo '<div class="row">
                <div class="col-md-4">
                    Toevoegen Klant
                </div>
                <div class="col-md-8">
                        <form action="#" method="post">
                                <input type="hidden" id="pw" name="pw" value="'.$loginController->passwordGenerator(10).'">
                              <div class="form-group">
                                <label for="customerlastname">Achternaam</label>
                                <input type="text" class="form-control" id="customerlastname" name="customerlastname" value="" required>
                              </div>
                              <div class="form-group">
                                <label for="customerfirstname">Voornaam</label>
                                <input type="text" class="form-control" id="customerfirstname" name="customerfirstname" value="" required>
                              </div>
                              <div class="form-group">
                                <label for="phonenumber">Telefoonnummner</label>
                                <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="" required>
                              </div>
                              <div class="form-group">
                                <label for="sex">Geslacht</label>
                                <select class="form-control" name="sex" required>
                                    <option value="m">man</option>
                                    <option value="v">vrouw</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="companyname">Bedrijfsnaam</label>
                                <input type="text" class="form-control" id="companyname" name="companyname" value="">
                              </div>
                              <div class="form-group">
                                <label for="email">Emailadres</label>
                                <input type="text" class="form-control" id="email" name="email" value="">
                              </div>

                              <div class="form-group">
                                <label for="districtnumber">Districtname</label>
                                    <select class="form-control" id="districtnumber" name="districtnumber">';

                                foreach($districts as $district){
                                    echo '<option value="'.$district['districtnumber'].'">'.$district['districtname'].'</option>';
                                }
                                echo '
                            </select>
                            </div>
                              <div class="form-group">
                                <label for="street">Straat</label>
                                <input type="text" class="form-control" id="street" name="street" value="" required>
                              </div>
                              <div class="form-group">
                                <label for="housenumber">Huisnummner</label>
                                <input type="number" class="form-control" id="housenumber" name="housenumber" value="" required>
                              </div>
                              <div class="form-group">
                                <label for="housenumberaddon">huisnummer toevoeging</label>
                                <input type="text" class="form-control" id="housenumberaddon" name="housenumberaddon" value="">
                              </div>
                              <div class="form-group">
                                <label for="zipcode">Postcode</label>
                                <input type="text" class="form-control" id="zipcode" name="zipcode" value="" required>
                              </div>
                              <div class="form-group">
                                <label for="city">Woonplaats</label>
                                <input type="text" class="form-control" id="city" name="city" value="" required>
                              </div>
                              <button type="submit" name="submit" id="submit" class="btn btn-default">Opslaan</button>
                        </form>
                    </div>
              </div>';
