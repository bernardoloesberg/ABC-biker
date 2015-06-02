<?php
/**
 * @author: Tom Kooiman
 */
    include_once('code/controllers/CustomerContactController.php');

    $CustomerContactController = new CustomerContactController();

    if(isset($_POST['changeContact'])){
        $result = $CustomerContactController->changeContact($_POST);

        if($result == 'success'){
            showMessage('success', 'Het contact is bijgewerkt!');
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
                              <input type="hidden" id="contactnumber" name="contactnumber" value="'.$_GET['id'].'" required>
                              <div class="form-group">
                                <label for="contactlastname">Achternaam</label>
                                <input type="text" class="form-control" id="contactlastname" name="contactlastname" value="'.$contact['contactlastname'].'" required>
                              </div>
                              <div class="form-group">
                                <label for="contactfirstname">Voornaam</label>
                                <input type="text" class="form-control" id="contactfirstname" name="contactfirstname" value="'.$contact['contactfirstname'].'" required>
                              </div>
                                <div class="form-group">
                                <label for="contactsex">Geslacht</label>
                                <select class="form-control" name="contactsex" required>
                                    <option value="m"'; if($contact['contactsex'] == 'm'){echo 'selected';} echo '>man</option>
                                    <option value="v"'; if($contact['contactsex'] == 'v'){echo 'selected';} echo '>vrouw</option>
                                </select>
                              </div>
                             <div class="form-group">
                                <label for="contactphonenumber">Telefoonnummer</label>
                                <input type="number" class="form-control" id="contactphonenumber" name="contactphonenumber" value="'.$contact['contactphonenumber'].'" required>
                              </div>
                            <div class="form-group">
                                <label for="contactdepartment">Afdeling</label>
                                <input type="text" class="form-control" id="contactdepartment" name="contactdepartment" value="'.$contact['contactdepartment'].'">
                              </div>
                            <div class="form-group">
                                <label for="contactemail">emailadres</label>
                                <input type="text" class="form-control" id="contactemail" name="contactemail" value="'.$contact['contactemail'].'">
                              </div>
                              <button type="submit" name="changeContact" class="btn btn-primary">Opslaan</button>
                        </form>';
            } else {
                echo 'Er is geen klantnummer!';
            }
    echo '    </div>
          </div>';
