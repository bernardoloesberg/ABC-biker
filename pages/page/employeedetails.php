<?php
/**
 * Created by PhpStorm.
 * User: Christiaan
 * Date: 21-5-2015
 * Time: 11:36
 */
include_once('code/controllers/EmployeeController.php');

$employeeController = new EmployeeController();

if(isset($_POST['deleteEmployee'])){
    $result = $employeeController->deleteEmployee($_POST);

    if($result){
        showMessage('success', 'U heeft een nieuwe employee verwijderd!');
    }else{
        showMessage('danger', 'Het verwijderen van een nieuwe employee is mislukt!');
    }
}

echo '<div class="row">
            <div class="col-md-4">
                Menu
            </div>
            <div class="col-md-8">';

if (isset($_GET['id'])) {
    $employee = $employeeController->getEmployee($_GET['id']);
    $birthparts = explode("-", $employee['birthday']);

    echo ' <table class="table">
                    <tbody>
                        <tr>
                             <td><label for="Persoonsgegevens">Persoongegevens</label></td>
                             <td></td>
                             <td><label for="Adresgegevens">Adresgegevens</label></td>
                             <td></td>
                        </tr>
                        <tr>
                            <td>Voornaam</td>
                            <td>' . $employee['employeefirstname'] . '</td>
                            <td>Straatnaam</td>
                            <td>' . $employee['street'] . '</td>
                        </tr>
                        <tr>
                            <td>Achternaam</td>
                            <td>' . $employee['employeelastname'] . '</td>
                            <td>Huisnummer</td>
                            <td>' . $employee['housenumber'] . '</td>
                        </tr>
                        <tr>
                            <td>Bsn-nummer</td>
                            <td>' . $employee['bsn'] . '</td>
                            <td>Toevoeging</td>
                            <td>' . ($employee['housenumberaddon'] == null ? '-' : $employee['housenumberaddon']) . '</td>
                        </tr>
                        <tr>
                            <td>Mobiel telefoonnummer</td>
                            <td>' . $employee['cellphone'] . '</td>
                            <td>Postcode</td>
                            <td>' . $employee['zipcode'] . '</td>
                        </tr>
                        <tr>
                            <td>Geboortedatum</td>
                            <td>' . $birthparts['2'] . '-' . $birthparts['1'] . '-' . $birthparts['0'] . '</td>
                            <td>Plaats</td>
                            <td>' . $employee['city'] . '</td>
                        </tr>
                        <tr>
                            <td>Geslacht</td>
                            <td>' .($employee['sex'] == 'V' ? 'Vrouw' : 'Man'). '</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
            </table>

     <a class="btn btn-primary" href="'.$_SESSION['rooturl'].'/employeechange/'.$employee['employeenumber'].'">Bewerken</a>
    ';
}

else{
    echo 'Geen nummer meegegeven';
}
echo'    </div>
          </div>';

loadscript($_SESSION['rooturl'].'/code/js/deleteHandlers.js');