<?php
/**
 * @author: Tom Kooiman
 */
    include_once('code/controllers/CustomerContactController.php');

    $CustomerContactController = new CustomerContactController();

if(isset($_SESSION['user']) && $_SESSION['user']['rolename'] == 'dispatcher'){
    if(isset($_POST['changeContact'])){
        $result = $CustomerContactController->addContactToCustomer($_POST);

        if($result == 'success'){
            showMessage('success', 'Het contact is aangemaakt!');
        }else{
            showMessage('danger', $result);
        }
    }

    echo '<div class="row">
            </div>
            <div class="col-md-10">';

            if (isset($_GET['id'])) {
                $contact = $CustomerContactController->getContact($_GET['id']);

                echo '<form action="#" method="post">
                              <div class="form-group">
                                <input type="hidden" id="customernumber" name="customernumber" value="'.$_GET['id'].'">
                                <label for="contactlastname">Achternaam</label>
                                <input type="text" class="form-control" id="contactlastname" name="contactlastname" value="" required>
                              </div>
                              <div class="form-group">
                                <label for="contactfirstname">Voornaam</label>
                                <input type="text" class="form-control" id="contactfirstname" name="contactfirstname" value="" required>
                              </div>
                                <div class="form-group">
                                <label for="contactsex">Geslacht</label>
                                <select class="form-control" name="contactsex" required>
                                    <option value="m">man</option>
                                    <option value="v">vrouw</option>
                                </select>
                              </div>
                             <div class="form-group">
                                <label for="contactphonenumber">Telefoonnummer</label>
                                <input type="number" class="form-control" id="contactphonenumber" name="contactphonenumber" value="" required>
                              </div>
                            <div class="form-group">
                                <label for="contactdepartment">Afdeling</label>
                                <input type="text" class="form-control" id="contactdepartment" name="contactdepartment" value="">
                              </div>
                            <div class="form-group">
                                <label for="contactemail">emailadres</label>
                                <input type="text" class="form-control" id="contactemail" name="contactemail" value="">
                              </div>
                              <button type="submit" name="changeContact" class="btn btn-primary">Opslaan</button>
                        </form>';
            } else {
                echo 'Er is geen klantnummer!';
            }
    echo '    </div>
          </div>';
}else{
    showMessage('danger', 'U heeft geen toegang tot deze pagina! Neem contact op met de beheerder.');
}
    