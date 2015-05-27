<?php
    /**
     * Created by PhpStorm.
     * User: Tom kooiman
     */
    include_once('code/controllers/CustomerController.php');

    $customerController = new CustomerController();

    if(isset($_POST['changeConsignment'])){
        $result = $customerController->changeCustomer($_POST);

        print_r($result);

        if($result){
            showMessage('success', 'De klant is bijgewerkt!');
        }else{
            showMessage('danger', 'De klant kon niet worden bijgewerkt!');
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
                              <div class="form-group">
                                <label for="pickupstreet">Straat</label>
                                <input type="text" class="form-control" id="pickupstreet" name="pickupstreet" value="'.$customer['customerlastname'].'">
                              </div>
                              <div class="form-group">
                                <label for="pickuphousenumber">Huisnummer</label>
                                <input type="text" class="form-control" id="pickuphousenumber" name="pickuphousenumber" value="'.$customer['customerfirstname'].'">
                              </div>
                              <div class="form-group">
                                <label for="pickuphousenumberaddon">Huisnummer toevoeging</label>
                                <input type="text" class="form-control" id="pickuphousenumberaddon" name="pickuphousenumberaddon" value="'.$customer['phonenumber'].'">
                              </div>
                              <div class="form-group">
                                <label for="pickupzipcode">Postcode</label>
                                <!--<input type="text" class="form-control" id="pickupzipcode" name="pickupzipcode" value="'.$customer['sex'].'"> -->
                              </div>
                              <div class="form-group">
                                <label for="pickupcity">Stad</label>
                                <input type="text" class="form-control" id="pickupcity" name="pickupcity" value="'.$customer['pickupcity'].'">
                              </div>
                              <div class="form-group">
                                <label for="consignorname">Getekend door</label>
                                <input type="text" class="form-control" id="consignorname" name="consignorname" value="'.$customer['consignorname'].'">
                              </div>
                              <div class="form-group">
                                <label for="completedlabel">Afgerond</label><br/>
                                <label class="radio-inline">
                                  <input type="radio" name="completed" id="completed1" value="1" '.($customer['completed'] == 1 ? 'checked' : '').'> Ja
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="completed" id="completed2" value="0" '.($customer['completed'] == 0 ? 'checked' : '').'> Nee
                                </label>
                              </div>
                              <div class="form-group date">
                                <label for="scheduledpickup">Ophaaltijd</label>
                                <input type="text" class="form-control" id="scheduledpickup" name="scheduledpickup" value="'.$customer['scheduledpickup'].'">
                              </div>
                              <div class="form-group date">
                                <label for="scheduleddelivery">Levertijd</label>
                                <input type="text" class="form-control" id="scheduleddelivery" name="scheduleddelivery" value="'.$customer['scheduleddelivery'].'">
                              </div>
                              <div class="form-group date">
                                <label for="price">Prijs</label>
                                <div class="input-group">
                                    <span class="input-group-addon">&euro;</span>
                                    <input type="text" class="form-control" id="price" name="price" value="'.$customer['price'].'">
                                </div>
                              </div>
                              <div class="form-group date">
                                <label for="totalprice">Totaal prijs</label>
                                <div class="input-group">
                                    <span class="input-group-addon">&euro;</span>
                                    <input type="text" class="form-control" id="totalprice" name="totalprice" value="'.$customer['totalprice'].'">
                                </div>
                              </div>
                              <div class="form-group date">
                                <label for="comment">Commentaar</label>
                                <input type="text" class="form-control" id="comment" name="comment" value="'.$consignme$customernt['comment'].'">
                                <input type="hidden" class="form-control" id="consignmentnumber" name="consignmentnumber" value="'.$customer['consignmentnumber'].'">
                              </div>
                              <button type="submit" name="changeConsignment" class="btn btn-primary">Save</button>
                        </form>';
            } else {
                echo 'Er is geen klantnummer!';
            }
    echo '    </div>
          </div>';
