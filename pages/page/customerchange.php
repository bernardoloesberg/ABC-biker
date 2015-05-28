<?php
/**
 * @author: Tom Kooiman
 */
    include_once('code/controllers/CustomerController.php');

    $customerController = new CustomerController();

    if(isset($_POST['changeCustomer'])){
        $result = $customerController->changeCustomer($_POST);

        if($result == 'success'){
            showMessage('success', 'De klant is bijgewerkt!');
        }else{
            showMessage('danger', $result);
        }
    }

    echo '<div class="row">
            <div class="col-md-2">
                Menu
            </div>
            <div class="col-md-10">';

            if (isset($_GET['id'])) {
                $customer = $customerController->getCustomer($_GET['id']);

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
                                <input type="number" class="form-control" id="phonenumber" name="phonenumber" value="'.$customer['phonenumber'].'" required>
                              </div>
                                <div class="form-group">
                                <label for="phonenumber">Geslacht</label>
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
                        </form>';
            } else {
                echo 'Er is geen klantnummer!';
            }
    echo '    </div>
          </div>';
