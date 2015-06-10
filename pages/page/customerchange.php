<?php
/**
 * @author: Tom Kooiman
 */
include_once('code/controllers/CustomerController.php');
include_once('code/controllers/CustomerContactController.php');
include_once('code/controllers/AddressForCustomerController.php');

if(isset($_SESSION['user']) && $_SESSION['user']['rolename'] == 'dispatcher'){

$customerController = new CustomerController();
$customerContactController = new CustomerContactController();
$addressForCustomerController = new AddressForCustomerController();


    if(isset($_POST['changeCustomer'])){
        $result = $customerController->changeCustomer($_POST);


        if($result == 'success'){
            showMessage('success', 'De klant is bijgewerkt!');
        }else{
            showMessage('danger', $result);
        }
    }

    echo '<div class="row">
            <div class="col-md-12">';

            if (isset($_GET['id'])) {
                $customer = $customerController->getCustomer($_GET['id']);
                $addressList = $addressForCustomerController->getCustomerAddress($_GET['id']);
                $contactList = $customerContactController->getCustomerContactList(($_GET['id']));

                echo '<form action="#" method="post">
                              <input type="hidden" id="customernumber" name="customernumber" value="'.$_GET['id'].'" required>
                              <div class="form-group">
                                <label for="customerlastname">Achternaam</label>
                                <input type="text" class="form-control" id="customerlastname" name="customerlastname" value="'.$customer['customerlastname'].'" required>
                              </div>
                              <div class="form-group">
                                <label for="customerfirstname">Voornaam</label>
                                <input type="text" class="form-control" id="customerfirstname" name="customerfirstname" value="'.$customer['customerfirstname'].'" required>
                              </div>
                              <div class="form-group">
                                <label for="phonenumber">Telefoonnummer</label>
                                <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="'.$customer['phonenumber'].'" required>
                              </div>
                                <div class="form-group">
                                <label for="sex">Geslacht</label>
                                <select class="form-control" name="sex" required>
                                    <option value="m"'; if($customer['sex'] == 'm'){echo 'selected';} echo '>man</option>
                                    <option value="v"'; if($customer['sex'] == 'v'){echo 'selected';} echo '>vrouw</option>
                                </select>
                              </div>
                            <div class="form-group">
                                <label for="companyname">Bedrijfsnaam</label>
                                <input type="text" class="form-control" id="companyname" name="companyname" value="'.$customer['companyname'].'">
                              </div>
                            <div class="form-group">
                                <label for="email">emailadres</label>
                                <input type="text" class="form-control" id="email" name="email" value="'.$customer['email'].'">
                              </div>
                              <button type="submit" name="changeCustomer" class="btn btn-primary">Opslaan</button>
                        </form>

                    <table class="table">
                        <thead>
                            <br>
                            <a class="btn btn-info" href="'.$_SESSION['rooturl'].'/addresscreate/'.$_GET['id'].'">Nieuw adres voor klant</a></td>
                            <br>
                            <strong>Addressen</strong>
                            <th>Postcode</th>
                            <th>Huisnummer</th>
                            <th>District</th>
                            <th>Bekijken</th>
                            <th>Bewerken</th>
                            <th>Verwijderen</th>
                        </thead>
                        <tbody class="searchable">';

                if(isset($addressList) && $addressList != 0) {
                    foreach ($addressList as $address) {
                        echo '<tr>
                 <td>' . $address['zipcode'] . '</td>
                 <td>' . $address['housenumber'] . ' ' . $address['housenumberaddon'] . '</td>
                 <td>' . $address['districtname'] . '</td>
                 <td><a class="btn btn-info" href="' . $_SESSION['rooturl'] . '/addressdetails/' . $address['addressnumber'] . '">Bekijken</a></td>
                 <td><a class="btn btn-primary" href="' . $_SESSION['rooturl'] . '/addresschange/' . $address['addressnumber'] . '">Bewerken</a></td>
                <td><button class="btn btn-danger deleteCustomerAddress" name="deleteCustomerAddress" value="' . $address['addressnumber'] . '" data-NG-customernumber="'.$_GET['id'].'">Verwijderen</button></td>
             </tr>';
                    }
                }

                echo '
                    </tbody>
                    </table>
                    <table class="table">
                        <thead>
                        <br>
                        <a class="btn btn-info" href="'.$_SESSION['rooturl'].'/contactcreate/'.$_GET['id'].'">Nieuw contact</a></td>
                        <br>
                            <strong>Contactgegevens</strong>
                            <th>naam</th>
                            <th>Geslacht</th>
                            <th>department</th>
                            <th>Bekijken</th>
                            <th>Bewerken</th>
                            <th>Verwijderen</th>
                        </thead>
                        <tbody class="searchable">';
                if(isset($contactList)) {
                    foreach ($contactList as $contact) {
                        echo '<tr>
                 <td>' . $contact['contactlastname'] . ' ' . $contact['contactfirstname'] . '</td>
                 <td>' . $contact['contactsex'] . '</td>
                 <td>' . $contact['contactdepartment'] . '</td>
                 <td><a class="btn btn-info" href="' . $_SESSION['rooturl'] . '/contactdetail/' . $contact['contactnumber'] . '">Bekijken</a></td>
                 <td><a class="btn btn-primary" href="' . $_SESSION['rooturl'] . '/contactchange/' . $contact['contactnumber'] . '">Bewerken</a></td>
                <td><button class="btn btn-danger deleteContact" name="deleteContact" value="' . $contact['contactnumber'] . '">Verwijderen</button></td>
             </tr>';
                    }
                }

                echo                '</tbody>
                    </table>
                </div>
          </div>
            </div>
          </div>';

            } else {
                echo 'Er is geen klantnummer!';
            }
    echo '    </div>
          </div>';

loadscript('../code/js/deleteHandlers.js');
}else{
    showMessage('danger', 'U heeft geen toegang tot deze pagina! Neem contact op met de beheerder.');
}
