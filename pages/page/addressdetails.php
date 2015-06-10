<?php
/**
 * Created by PhpStorm.
 * User: Christiaan
 * Date: 29-5-2015
 * Time: 9:19
 */

include_once('code/controllers/AddressController.php');

if(isset($_SESSION['user']) && $_SESSION['user']['rolename'] == 'dispatcher'){
    $addressController = new AddressController();

    if(isset($_POST['deleteAddress'])){
        $result = $addressController->deleteAddress($_POST);

        if($result){
            showMessage('success', 'U heeft een address verwijderd!');
        }else{
            showMessage('danger', 'Het verwijderen van een address is mislukt!');
        }
    }

    echo '<div class="row">
                <div class="col-md-12">';
                if (isset($_GET['id'])) {
                    $address = $addressController->getAddress($_GET['id']);
    echo '
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Straatnaam</td>
                                <td>' . $address['street'] . '</td>
                                <td>Postcode</td>
                                <td>' . $address['zipcode'] . '</td>
                            </tr>
                            <tr>
                                <td>Huisnummer</td>
                                <td>' . $address['housenumber'] . '</td>
                                <td>Plaats</td>
                                <td>' . $address['city'] . '</td>
                            </tr>
                            <tr>
                                <td>Toevoeging</td>
                                <td>' . ($address['housenumberaddon'] == null ? '-' : $address['housenumberaddon']) . '</td>
                                <td>District</td>
                                <td>' . $address['districtname'].'</td>
                            </tr>
                        </tbody>
                </table>

         <a class="btn btn-primary" href="'.$_SESSION['rooturl'].'/addresschange/'.$address['addressnumber'].'">Bewerken</a>
        ';
    }

    else{
        echo 'Geen nummer meegegeven';
    }
    echo'    </div>
              </div>';

}else{
    showMessage('danger', 'U heeft geen toegang tot deze pagina! Neem contact op met de beheerder.');
}