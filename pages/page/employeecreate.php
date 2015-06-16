<?php
/**
 * Created by PhpStorm.
 * User: Christiaan
 * Date: 18-5-2015
 * Time: 9:42
 */
include_once('code/controllers/EmployeeController.php');

if(isset($_SESSION['user']) && $_SESSION['user']['rolename'] == 'dispatcher'){
$employeeController = new EmployeeController();

if(isset($_POST['createEmployee'])){
    $result = $employeeController->createEmployee($_POST);

    if($result == 'success'){
        showMessage('success', 'U heeft een nieuwe employee toegevoegd!');
    }else{
        showMessage('danger',$result);
    }
}

echo '<div class="row">
            <div class="col-md-12">
                           <form action="#" method="post">
                           <div class="form-group">
                            <div class="col-md-4">
                                <label for="Voornaam">Voornaam*</label>
                                <input type="text" class="form-control" id="employeeLastname" name="employeeFirstName" value="">
                            </div>
                            <div class="col-md-4">
                                <label for="Achternaam">Achternaam*</label>
                                <input type="text" class="form-control" id="employeeLastName" name="employeeLastName" value="">
                            </div>
                              <div class="col-md-4">
                                <label for="Bsn-nummer">Bsn-nummer*</label>
                                <input type="text" class="form-control" id="bsn" name="bsn" value="">
                              </div>
                            </div>
                          <div class="form-group">
                            <div class="col-md-4">
                                <label for="Geboortedag">Geboortedatum(dag)*</label>
                                <input type="text" class="form-control" id="birthday" name="birthday" value="">
                              </div>
                              <div class="col-md-4">
                                <label for="Geboortemaand">Geboortedatum(maand)*</label>
                                <input type="text" class="form-control" id="birthmonth" name="birthmonth" value="">
                              </div>
                              <div class="col-md-4">
                                <label for="Geboortejaar">Geboortedatum(jaar)*</label>
                                <input type="text" class="form-control" id="birthyear" name="birthyear" value="">
                              </div>
                          </div>
                          <div class="form-group">
                            <div class="col-md-4">
                                <label for="Mobiel Telefoonnummer">Mobiel Telefoonnummer*</label>
                                <input type="text" class="form-control" id="cellphone" name="cellphone" value="">
                              </div>
                              <div class="col-md-4">
                                <label for="geslacht">Geslacht*</label>
                                <select class="form-control" name="sex">
                                    <option value="M">Man</option>
                                    <option value="V">Vrouw</option>
                                </select>
                              </div>
                              <div class="col-md-4">
                                <label for="Postcode">Postcode*</label>
                                <input type="text" class="form-control" id="zipcode" name="zipcode" value="">
                          </div>
                          <div class="form-group">
                              <div class="col-md-4">
                                <label for="straat">Straat*</label>
                                <input type="text" class="form-control" id="street" name="street" value="">
                              </div>
                              <div class="col-md-2">
                                <label for="Huisnummer">Huisnummer*</label>
                                <input type="text" class="form-control" id="housenumber" name="housenumber" value="">
                              </div>
                              <div class="col-md-2">
                                <label for="Toevoeging">Toevoeging</label>
                                <input type="text" class="form-control" id="housenumberaddon" name="housenumberaddon" value="">
                              </div>
                              <div class="col-md-4">
                                <label for="Plaats">Plaats*</label>
                                <input type="text" class="form-control" id="city" name="city" value="">
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="col-md-2">
                                  <label for="biker">Biker</label>
                                  <span class="input-group-addon">
                                    <input type="checkbox" class="biker" id="biker" name="biker" onclick="function()" value="true">
                                  </span>
                              </div>
                              <div id="hiddenFields" style="visibility: hidden;">
                                  <div class="col-md-2">
                                  <label for="express">Express</label>
                                  <span class="input-group-addon">
                                    <input type="checkbox" name="express" value="true">
                                  </span>
                                  </div>
                                  <div class="col-md-4">
                                    <label for="max">max-verzendingen</label>
                                    <input type="text" class="form-control" id="max" name="max" value="">
                                  </div>
                              </div>
                              <div class="col-md-2">
                                  <label for="bus">Bus</label>
                                  <span class="input-group-addon">
                                    <input type="checkbox" class="bus" name="bus" value="true">
                                  </span>
                              </div>
                              <div class="col-md-2">
                                  <label for="dispatcher">Dispatcher</label>
                                  <span class="input-group-addon">
                                    <input type="checkbox" class="dispatcher" name="dispatcher" value="true">
                                  </span>
                              </div>
                          </div>
                          <div class="form-group">
                            Velden met een * zijn verplicht
                          </div>
                          <button type="submit" name="createEmployee" class="btn btn-primary">Opslaan</button>
                        </form>
                </div>
          </div>';

loadscript('code/js/employee.js');
}else{
    showMessage('danger', 'U heeft geen toegang tot deze pagina! Neem contact op met de beheerder.');
}