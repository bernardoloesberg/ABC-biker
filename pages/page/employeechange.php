<?php
/**
 * Created by PhpStorm.
 * User: Christiaan
 * Date: 18-5-2015
 * Time: 11:12
 */
include_once('code/controllers/EmployeeController.php');

$employeeController = new EmployeeController();

if(isset($_POST['changeEmployee'])){
    $result = $employeeController->changeEmployee($_POST);

    if($result){
        showMessage('success', 'U heeft een employee gewijzigd!');
    }else{
        showMessage('danger', 'Het wijzigen van een employee is mislukt!');
    }
}

echo '<div class="row">
            <div class="col-md-4">
                Menu
            </div>
            <div class="col-md-8">';

            if (isset($_GET['id'])) {
                $employee = $employeeController->getEmployee($_GET['id']);
                $birthparts = explode("-",$employee['birthday']);


                echo '    <form action="#" method="post">
                          <div class="form-group">
                            <label for="Employeenumber">Employeenumber</label>
                            <input type="text" class="form-control" id="employeenumber" name="employeenumber" value="'.$employee['employeenumber'].'" readonly="readonly">
                          </div>
                          <div class="form-group">
                            <label for="Voornaam">Voornaam</label>
                            <input type="text" class="form-control" id="employeeLastname" name="employeeFirstName" value="'.$employee['employeefirstname'].'">
                          </div>
                          <div class="form-group">
                            <label for="Achternaam">Achternaam</label>
                            <input type="text" class="form-control" id="employeeLastName" name="employeeLastName" value="'.$employee['employeelastname'].'">
                          </div>
                          <div class="form-group">
                            <label for="Bsn-nummer">Bsn-nummer</label>
                            <input type="text" class="form-control" id="bsn" name="bsn" value="'.$employee['bsn'].'">
                          </div>
                          <div class="form-group">
                            <label for="Mobiel Telefoonnummer">Mobiel Telefoonnummer</label>
                            <input type="text" class="form-control" id="cellphone" name="cellphone" value="'.$employee['cellphone'].'">
                          </div>
                          <div class="form-group">
                            <label for="Geboortedag">Geboortedag</label>
                            <input type="text" class="form-control" id="birthday" name="birthday" value="'.$birthparts['2'].'">
                          </div>
                          <div class="form-group">
                            <label for="Geboortemaand">Geboortemaand</label>
                            <input type="text" class="form-control" id="birthmonth" name="birthmonth" value="'.$birthparts['1'].'">
                          </div>
                          <div class="form-group">
                            <label for="Geboortejaar">Geboortejaar</label>
                            <input type="text" class="form-control" id="birthyear" name="birthyear" value="'.$birthparts['0'].'">
                          </div>
                          <div class="form-group">
                            <label for="geslacht">Geslacht</label>
                            <select class="form-control" name="sex">
                                <option value="'.($employee['sex'] == 'V' ? 'M' : 'V').'">'.($employee['sex'] == 'V' ? 'Vrouw' : 'Man').'</option>
                                <option value="'.($employee['sex'] == 'V' ? 'M' : 'V').'">'.($employee['sex'] == 'V' ? 'Man' : 'Vrouw').'</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="straat">Straat</label>
                            <input type="text" class="form-control" id="street" name="street" value="'.$employee['street'].'">
                          </div>
                          <div class="form-group">
                            <label for="Huisnummer">Huisnummer</label>
                            <input type="text" class="form-control" id="housenumber" name="housenumber" value="'.$employee['housenumber'].'">
                          </div>
                          <div class="form-group">
                            <label for="Toevoeging">Toevoeging</label>
                            <input type="text" class="form-control" id="housenumberaddon" name="housenumberaddon" value="'.$employee['housenumberaddon'].'">
                          </div>
                          <div class="form-group">
                            <label for="Postcode">Postcode</label>
                            <input type="text" class="form-control" id="zipcode" name="zipcode" value="'.$employee['zipcode'].'">
                          </div>
                          <div class="form-group">
                            <label for="Plaats">Plaats</label>
                            <input type="text" class="form-control" id="city" name="city" value="'.$employee['city'].'">
                          </div>
                          <button type="submit" class="btn btn-success" name="changeEmployee">Sla verandering op</button>
                        </form>';
            }
            else{
                echo 'Geen nummer meegegeven';
            }
            echo'    </div>
          </div>';
