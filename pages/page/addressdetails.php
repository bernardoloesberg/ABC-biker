<?php
/**
 * Created by PhpStorm.
 * User: Christiaan
 * Date: 29-5-2015
 * Time: 9:19
 */

include_once('code/controllers/AddressController.php');

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
            <div class="col-md-4">
                Menu
            </div>
            <div class="col-md-8">';
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
                            <td>Achternaam</td>
                            <td>' . $address['housenumber'] . '</td>
                            <td>Huisnummer</td>
                            <td>' . $address['city'] . '</td>
                        </tr>
                        <tr>
                            <td>Bsn-nummer</td>
                            <td>' . ($address['housenumberaddon'] == null ? '-' : $address['housenumberaddon']) . '</td>
                            <td>Toevoeging</td>
                            <td>' . ($address['districtname'].'</td>
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