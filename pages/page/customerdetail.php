<?php
    /**
     * Created by PhpStorm.
     * User: Tom kooiman
     */
    include_once('code/controllers/CustomerController.php');
    include_once('code/controllers/CustomerContactController.php');
    include_once('code/controllers/AddressForCustomerController.php');


    $customerController = new CustomerController();
    $customerContactController = new CustomerContactController();
    $addressForCustomerController = new AddressForCustomerController();

    if(isset($_GET['id'])) {
        $customer = $customerController->getCustomer($_GET['id']);
        $addressList = $addressForCustomerController->getCustomerAddress($_GET['id']);
        $contactList = $customerContactController->getCustomerContactList(($_GET['id']));

        echo '<div class="row">
            <div class="col-md-2">
                Menu
            </div>
            <div class="col-md-10">
                <table class="table">
                    <thead>
                        <tr><td><strong>Klantgegevens</strong></td>
                            <td></td></tr>
                    </thead>

                    <tbody>
                        <tr><td>Achternaam</td>
                            <td>' . $customer['customerlastname'] . '</td>
                            <td>Voornaam</td>
                            <td>' . $customer['customerfirstname'] . '</td>
                            <td>Telefoonnummer</td>
                            <td>' . $customer['phonenumber'] . '</td></tr>
                        <tr><td>Geslacht</td>
                            <td>' . $customer['sex'] . '</td>
                            <td>Bedrijfsnaam</td>
                            <td>' . $customer['companyname'] . '</td>
                            <td>email</td>
                            <td>' . $customer['email'] . '</td></tr>
                    </tbody>
                </table>
                    <table class="table">
                        <thead>
                            <strong>Addressen</strong>
                            <th>Postcode</th>
                            <th>Huisnummer</th>
                            <th>District</th>
                            <th>Bekijken</th>
                        </thead>
                        <tbody class="searchable">';
        if(isset($addressList) && $addressList != 0) {
            foreach ($addressList as $address) {
                echo '<tr>
                 <td>' . $address['zipcode'] . '</td>
                 <td>' . $address['housenumber'] . ' ' . $address['housenumberaddon'] . '</td>
                 <td>' . $address['districtname'] . '</td>
                 <td><a class="btn btn-info" href="' . $_SESSION['rooturl'] . '/addressdetails/' . $address['addressnumber'] . '">Bekijken</a></td>
             </tr>';
            }
        }

        echo '
                    </tbody>
                    </table>
                    <table class="table">
                        <thead>
                            <strong>Contactgegevens</strong>
                            <th>naam</th>
                            <th>Geslacht</th>
                            <th>department</th>
                            <th>Bekijken</th>
                        </thead>
                        <tbody class="searchable">';
        if(isset($contactList)) {
            foreach ($contactList as $contact) {
                echo '<tr>
                 <td>' . $contact['contactlastname'] . ' ' . $contact['contactfirstname'] . '</td>
                 <td>' . $contact['contactsex'] . '</td>
                 <td>' . $contact['contactdepartment'] . '</td>
                 <td><a class="btn btn-info" href="' . $_SESSION['rooturl'] . '/contactdetail/' . $contact['contactnumber'] . '">Bekijken</a></td>
             </tr>';
            }
        }

        echo                '</tbody>
                    </table>
                </div>
          </div>
            </div>
          </div>';
    }

