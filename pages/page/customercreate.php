<?php
    include_once('code/controllers/CustomerController.php');

    $customerController = new CustomerController();

    if(isset($_POST['submit'])){
        $result = $customerController->createCustomer($_POST['achternaam'],$_POST['voornaam'],$_POST['telefoonnummner'],$_POST['geslacht'], $_POST['bedrijfsnaam'],$_POST['contactachternaam'], $_POST['contactvoornaam'], $_POST['emailadres']);
        print_r($result);
        print_r($_POST);

    }

    echo '<div class="row">
                <div class="col-md-4">
                    Toevoegen Klant
                </div>
                <div class="col-md-8">
                        <form action="#" method="post">
                              <div class="form-group">
                                <label for="achternaam">Achternaam</label>
                                <input type="text" class="form-control" id="achternaam" name="achternaam" value="">
                              </div>
                              <div class="form-group">
                                <label for="voornaam">Voornaam</label>
                                <input type="text" class="form-control" id="voornaam" name="voornaam" value="">
                              </div>
                              <div class="form-group">
                                <label for="telefoonnummner">Telefoonnummner</label>
                                <input type="text" class="form-control" id="telefoonnummner" name="telefoonnummner" value="">
                              </div>
                              <div class="form-group">
                                <label for="geslacht">Geslacht</label>
                                <select class="form-control" name="geslacht">
                                    <option value="m">man</option>
                                    <option value="v">vrouw</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="bedrijfsnaam">Bedrijfsnaam</label>
                                <input type="text" class="form-control" id="bedrijfsnaam" name="bedrijfsnaam" value="">
                              </div>
                              <div class="form-group">
                                <label for="contactachternaam">Contact Achternaam</label>
                                <input type="text" class="form-control" id="contactachternaam" name="contactachternaam" value="">
                              </div>
                              <div class="form-group">
                                <label for="contactvoornaam">Contact Voornaam</label>
                                <input type="text" class="form-control" id="contactvoornaam" name="contactvoornaam" value="">
                              </div>
                              <div class="form-group">
                                <label for="emailadres">Emailadres</label>
                                <input type="text" class="form-control" id="emailadres" name="emailadres" value="">
                              </div>

                              <button type="submit" name="submit" id="submit" class="btn btn-default">Volgende</button>
                        </form>
                    </div>
              </div>';
