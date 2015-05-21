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
        showMessage('succes', 'U heeft een nieuwe employee verwijderd!');
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
                    <form action="#" method="post">

                    <tbody>
                        <tr>
                            <td><label for="Employeenumber">Employeenumber</label></td>
                            <td>' . $employee['employeenumber'] . '</td>
                            <td></td>
                            <td></td>
                        </tr>
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
                            <td>huisnummer</td>
                            <td>' . $employee['housenumber'] . '</td>
                        </tr>
                        <tr>
                            <td>bsn-nummer</td>
                            <td>' . $employee['bsn'] . '</td>
                            <td>toevoeging</td>
                            <td>' . $employee['housenumberaddon'] . '</td>
                        </tr>
                        <tr>
                            <td>mobiele telefoonnummer</td>
                            <td>' . $employee['cellphone'] . '</td>
                            <td>postcode</td>
                            <td>' . $employee['zipcode'] . '</td>
                        </tr>
                        <tr>
                            <td>geboortedatum</td>
                            <td>' . $birthparts['2'] . '-' . $birthparts['1'] . '-' . $birthparts['0'] . '</td>
                            <td>plaats</td>
                            <td>' . $employee['city'] . '</td>
                        </tr>
                        <tr>
                            <td>Geslacht</td>
                            <td>' . $employee['sex'] . '</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
            </table>

     <a class="btn btn-primary" href="'.$_SESSION['rooturl'].'/employeechange/'.$employee['employeenumber'].'">Bewerken</a>
     <button class="btn btn-danger deleteConsignment" name="deleteEmployee" value="'.$employee['employeenumber'].'">Verwijderen</button>
     </form>
    ';
}

else{
    echo 'Geen nummer meegegeven';
}
echo'    </div>
          </div>';
