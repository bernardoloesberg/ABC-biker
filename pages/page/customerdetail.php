<?php
    /**
     * Created by PhpStorm.
     * User: Tom kooiman
     */
    include_once('code/controllers/CustomerController.php');


    $customerController = new CustomerController();

    if(isset($_GET['id'])) {
        $customer = $customerController->getCustomer($_GET['id']);

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
            </div>
          </div>';

        echo '</tbody>
                    </table>
                </div>
          </div>';
    }