<?php
    /**
     * Created by PhpStorm.
     * User: Bernardo
     */
    include_once('code/controllers/CustomerController.php');
    include_once('code/controllers/CustomerContactController.php');

if(isset($_SESSION['user']) && $_SESSION['user']['rolename'] == 'dispatcher' || isset($_SESSION['user']) && $_SESSION['user']['rolename'] == 'manager'){
    $customerController = new CustomerController();
    $CustomerContactController = new CustomerContactController();



    if(isset($_GET['id'])) {
        $contact = $CustomerContactController->getContact(($_GET['id']));

        echo '<div class="row">
            <div class="col-md-10">
                <table class="table">
                    <thead>
                        <tr><td><strong>Contactgegevens</strong></td>
                            <td></td></tr>
                    </thead>
                    <tbody>
                        <tr><td>Achternaam</td>
                            <td>'.$contact['contactlastname'].'</td>
                            <td>voornaam</td>
                            <td>'.$contact['contactfirstname'].'</td>
                            <td>Geslacht</td>
                            <td>'.$contact['contactsex'].'</td></tr>
                        <tr><td>Telefoonnummer</td>
                            <td>'.$contact['contactphonenumber'].'</td>
                            <td>email</td>
                            <td>'.$contact['contactemail'].'</td>
                            <td>Afdeling</td>
                            <td>'.$contact['contactdepartment'].'</td></tr>
                    </tbody>
                </table>
            </div>
          </div>';
    }else{
        echo 'Er is geen consignment nummer opgegeven';
    }
}else{
    showMessage('danger', 'U heeft geen toegang tot deze pagina! Neem contact op met de beheerder.');
}
