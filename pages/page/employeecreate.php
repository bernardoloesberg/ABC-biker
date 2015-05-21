<?php
/**
 * Created by PhpStorm.
 * User: Christiaan
 * Date: 18-5-2015
 * Time: 9:42
 */
include_once('code/controllers/EmployeeController.php');

$employeeController = new EmployeeController();

if(isset($_POST['createEmployee'])){
    $result = $employeeController->createEmployee($_POST);

    if($result){
        showMessage('succes', 'U heeft een nieuwe employee toegevoegd!');
    }else{
        showMessage('danger', 'Het toevoegen van een nieuwe employee is mislukt!');
    }
}

echo '<div class="row">
            <div class="col-md-4">
                Menu
            </div>
            <div class="col-md-8">
                           <form action="#" method="post">
                           <div class="form-group">
                            <label for="Voornaam">Voornaam</label>
                            <input type="text" class="form-control" id="employeeLastname" name="employeeFirstName" value="">
                          </div>
                          <div class="form-group">
                            <label for="Achternaam">Achternaam</label>
                            <input type="text" class="form-control" id="employeeLastName" name="employeeLastName" value="">
                          </div>
                          <div class="form-group">
                            <label for="Bsn-nummer">Bsn-nummer</label>
                            <input type="text" class="form-control" id="bsn" name="bsn" value="">
                          </div>
                          <div class="form-group">
                            <label for="Mobiel Telefoonnummer">Mobiel Telefoonnummer</label>
                            <input type="text" class="form-control" id="cellphone" name="cellphone" value="">
                          </div>
                          <div class="form-group">
                            <label for="Geboortedag">Geboortedag</label>
                            <input type="text" class="form-control" id="birthday" name="birthday" value="">
                          </div>
                          <div class="form-group">
                            <label for="Geboortemaand">Geboortemaand</label>
                            <input type="text" class="form-control" id="birthmonth" name="birthmonth" value="">
                          </div>
                          <div class="form-group">
                            <label for="Geboortejaar">Geboortejaar</label>
                            <input type="text" class="form-control" id="birthyear" name="birthyear" value="">
                          </div>
                          <div class="form-group">
                            <label for="geslacht">Geslacht</label>
                            <select class="form-control" name="sex">
                                <option value="m">Man</option>
                                <option value="v">Vrouw</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="straat">Straat</label>
                            <input type="text" class="form-control" id="street" name="street" value="">
                          </div>
                          <div class="form-group">
                            <label for="Huisnummer">Huisnummer</label>
                            <input type="text" class="form-control" id="housenumber" name="housenumber" value="">
                          </div>
                          <div class="form-group">
                            <label for="Toevoeging">Toevoeging</label>
                            <input type="text" class="form-control" id="housenumberaddon" name="housenumberaddon" value="">
                          </div>
                          <div class="form-group">
                            <label for="Postcode">Postcode</label>
                            <input type="text" class="form-control" id="zipcode" name="zipcode" value="">
                          </div>
                          <div class="form-group">
                            <label for="Plaats">Plaats</label>
                            <input type="text" class="form-control" id="city" name="city" value="">
                          </div>
                          <button type="submit" name="createEmployee" class="btn btn-primary">Create</button>
                        </form>
                </div>
          </div>';
