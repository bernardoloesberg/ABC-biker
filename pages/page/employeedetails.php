<?php
/**
 * Created by PhpStorm.
 * User: Christiaan
 * Date: 21-5-2015
 * Time: 11:36
 */
include_once('code/controllers/EmployeeController.php');

if(isset($_SESSION['user']) && $_SESSION['user']['rolename'] == 'dispatcher' || isset($_SESSION['user']) && $_SESSION['user']['rolename'] == 'manager'){
$employeeController = new EmployeeController();

echo '<div class="row">
            <div class="col-md-4">
                Menu
            </div>
            <div class="col-md-8">';

if (isset($_GET['id'])) {
    $employee = $employeeController->getEmployee($_GET['id']);
    $birthparts = explode("-", $employee['birthday']);
    if($employee['biker'] == 'biker'){
        $biker = $employeeController->getBiker($_GET['id']);
    }

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
                        <tr>
                            <td>Biker</td>
                            <td>' .($employee['biker'] == 'biker' ? 'Ja' : '-'). '</td>
                            <td>Bus</td>
                            <td>' .($employee['bus'] == 'bus' ? 'Ja' : '-'). '</td>
                        </tr>
                        <tr>
                            <td>Dispatcher</td>
                            <td>' .($employee['dispatcher'] == 'dispatcher' ? 'Ja' : '-'). '</td>
                            <td></td>
                            <td></td>
                        </tr>';
                        if($employee['biker'] == 'biker'){
echo '                        <tr>
                            <td>Express</td>
                            <td>' .($biker['express'] == true ? 'Ja' : '-'). '</td>
                            <td>aantal pakketjes</td>
                            <td>'.$biker['maxdeliveries'].'</td>
                        </tr>';
                        }
echo ' </tbody>
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
}else{
    showMessage('danger', 'U heeft geen toegang tot deze pagina! Neem contact op met de beheerder.');
}
