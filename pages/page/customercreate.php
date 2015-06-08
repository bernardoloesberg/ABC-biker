<?php
    include_once('code/controllers/CustomerController.php');

    $customerController = new CustomerController();

    if(isset($_POST['submit'])){
        $result = $customerController->createCustomer($_POST);

        if($result == 'success') {
            showMessage('success','De klant is succesvol aangemaakt!');
        } else {
            showMessage('danger',$result);
        }
    }

    echo '<div class="row">
                <div class="col-md-4">
                    Toevoegen Klant
                </div>
                <div class="col-md-8">
                        <form action="#" method="post">
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
                                <label for="districtnumber">District</label>
                                <select name="districtnumber" class="form-control">

                                    <option value="1">1 | Arnhem</option> ';// TODO: Feed this select with the district table.
                                    echo '
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="street">Straat</label>
                                <input type="text" class="form-control" id="street" name="street" value="" required>
                              </div>
                              <div class="form-group">
                                <label for="zipcode">Postcode</label>
                                <input type="text" class="form-control" id="zipcode" name="zipcode" value="" required>
                              </div>
                              <div class="form-group">
                                <label for="housenumber">Huisnummner</label>
                                <input type="number" class="form-control" id="housenumber" name="housenumber" value="" required>
                              </div>
                              <div class="form-group">
                                <label for="city">Woonplaats</label>
                                <input type="text" class="form-control" id="city" name="city" value="" required>
                              </div>
                              <div class="form-group">
                                <label for="housenumberaddon">huisnummer toevoeging</label>
                                <input type="text" class="form-control" id="housenumberaddon" name="housenumberaddon" value="">
                              </div>

                              <button type="submit" name="submit" id="submit" class="btn btn-default">Opslaan</button>
                        </form>
                    </div>
              </div>';