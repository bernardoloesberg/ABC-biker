<?php
/**
 * Created by PhpStorm.
 * User: Christiaan
 * Date: 18-5-2015
 * Time: 11:12
 */
if(isset($_SESSION['user']) && $_SESSION['user']['rolename'] == 'dispatcher'){
include_once('code/controllers/EmployeeController.php');

$employeeController = new EmployeeController();

if(isset($_POST['changeEmployee'])){
    $result = $employeeController->changeEmployee($_POST);

    if($result == 'success' ){
        showMessage('success', 'U heeft een employee gewijzigd!');
    }else{
        showMessage('danger', $result);
    }
}

echo '<div class="row">
            <div class="col-md-12">';

            if (isset($_GET['id'])) {
                $employee = $employeeController->getEmployee($_GET['id']);
                $birthparts = explode("-",$employee['birthday']);
                if($employee['biker'] == 'biker'){
                    $biker = $employeeController->getBiker($_GET['id']);
                }
                else{
                    $biker['maxdeliveries'] = 0;
                    $biker['express'] = 0;
                }


                echo '    <form action="#" method="post">
                          <div class="form-group" style="display: none;">
                            <label for="employeenumber">Voornaam</label>
                            <input type="text" class="form-control" id="employeenumber" name="employeenumber" value="'.$employee['employeenumber'].'">
                          </div>
                          <div class="form-group">
                              <div class="col-md-4">
                                <label for="Voornaam">Voornaam</label>
                                <input type="text" class="form-control" id="employeeLastname" name="employeeFirstName" value="'.$employee['employeefirstname'].'">
                              </div>
                              <div class="col-md-4">
                                <label for="Achternaam">Achternaam</label>
                                <input type="text" class="form-control" id="employeeLastName" name="employeeLastName" value="'.$employee['employeelastname'].'">
                              </div>
                              <div class="col-md-4">
                                <label for="Bsn-nummer">Bsn-nummer</label>
                                <input type="text" class="form-control" id="bsn" name="bsn" value="'.$employee['bsn'].'">
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="col-md-4">
                                <label for="Geboortedag">Geboortedag</label>
                                <input type="text" class="form-control" id="birthday" name="birthday" value="'.$birthparts['2'].'">
                              </div>
                              <div class="col-md-4">
                                <label for="Geboortemaand">Geboortemaand</label>
                                <input type="text" class="form-control" id="birthmonth" name="birthmonth" value="'.$birthparts['1'].'">
                              </div>
                              <div class="col-md-4">
                                <label for="Geboortejaar">Geboortejaar</label>
                                <input type="text" class="form-control" id="birthyear" name="birthyear" value="'.$birthparts['0'].'">
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="col-md-4">
                                <label for="Mobiel Telefoonnummer">Mobiel Telefoonnummer</label>
                                <input type="text" class="form-control" id="cellphone" name="cellphone" value="'.$employee['cellphone'].'">
                              </div>
                              <div class="col-md-4">
                                <label for="geslacht">Geslacht</label>
                                <select class="form-control" name="sex">
                                    <option value="'.($employee['sex'] == 'V' ? 'V' : 'M').'">'.($employee['sex'] == 'V' ? 'Vrouw' : 'Man').'</option>
                                    <option value="'.($employee['sex'] == 'V' ? 'M' : 'V').'">'.($employee['sex'] == 'V' ? 'Man' : 'Vrouw').'</option>
                                </select>
                              </div>
                              <div class="col-md-4">
                                <label for="Postcode">Postcode</label>
                                <input type="text" class="form-control" id="zipcode" name="zipcode" value="'.$employee['zipcode'].'">
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="col-md-4">
                                <label for="straat">Straat</label>
                                <input type="text" class="form-control" id="street" name="street" value="'.$employee['street'].'">
                              </div>
                              <div class="col-md-2">
                                <label for="Huisnummer">Huisnummer</label>
                                <input type="text" class="form-control" id="housenumber" name="housenumber" value="'.$employee['housenumber'].'">
                              </div>
                              <div class="col-md-2">
                                <label for="Toevoeging">Toevoeging</label>
                                <input type="text" class="form-control" id="housenumberaddon" name="housenumberaddon" value="'.$employee['housenumberaddon'].'">
                              </div>
                              <div class="col-md-4">
                                <label for="Plaats">Plaats</label>
                                <input type="text" class="form-control" id="city" name="city" value="'.$employee['city'].'">
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="col-md-2">
                                  <label for="biker">Biker</label>
                                  <span class="input-group-addon">
                                    <input type="checkbox" class="biker" id="biker" name="biker" onclick="function()" value="true"'
                                        .($employee['biker'] == 'biker' ? 'checked="checked"':'').'>';
echo'                    </span>
                              </div>
                              <div id="hiddenFields"' .($employee['biker'] != 'biker' ? 'style="visibility: hidden;"':'').'>
                                  <div class="col-md-2">
                                  <label for="express">Express</label>
                                  <span class="input-group-addon">
                                    <input type="checkbox" name="express" value="true"'
                                    .($biker['express'] ? 'checked="checked"':'').'>';
    echo'
                                  </span>
                                  </div>
                                  <div class="col-md-4">
                                    <label for="max">max-verzendingen</label>
                                    <input type="text" class="form-control" id="max" name="max" value="'.$biker['maxdeliveries'].'">
                                  </div>
                              </div>
                              <div class="col-md-2">
                                  <label for="bus">Bus</label>
                                  <span class="input-group-addon">
                                    <input type="checkbox" class="bus" name="bus" value="true"'
                                    .($employee['bus'] == 'bus' ? 'checked="checked"':'').'>';
echo'                                    </span>
                              </div>
                              <div class="col-md-2">
                                  <label for="dispatcher">Dispatcher</label>
                                  <span class="input-group-addon">
                                    <input type="checkbox" class="dispatcher" name="dispatcher" value="true"'
                                    .($employee['dispatcher'] == 'dispatcher' ? 'checked="checked"':'').'>';
echo'             </span>
                              </div>
                          </div>
                          <button type="submit" class="btn btn-success" name="changeEmployee">Sla verandering op</button>
                        </form>';
            }
            else{
                echo 'Geen nummer meegegeven';
            }
            echo'    </div>
          </div>';

loadscript('../code/js/employee.js');
}else{
    showMessage('danger', 'U heeft geen toegang tot deze pagina! Neem contact op met de beheerder.');
}