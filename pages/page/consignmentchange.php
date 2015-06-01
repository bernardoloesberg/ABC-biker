<?php
    /**
     * Created by PhpStorm.
     * User: Bernardo
     *
     * TODO: Employeenumber needs to be added in the stored procedure. Its now set to employeenumber 8.
     */
    include_once('code/controllers/ConsignmentController.php');
    include_once('code/controllers/CustomerController.php');

    $consignmentController = new ConsignmentController();
    $customerController = new CustomerController();

    if(isset($_POST['changeConsignment'])){
        $result = $consignmentController->changeConsignment($_POST);

        print_r($result);

        if($result){
            showMessage('success', 'De consignment is bijgewerkt!');
        }else{
            showMessage('danger', 'De consignment kon niet worden bijgewerkt!');
        }
    }

    echo '<div class="row">
            <div class="col-md-2">
                Menu
            </div>
            <div class="col-md-10">';

            if (isset($_GET['id'])) {
                $consignment = $consignmentController->getConsignment($_GET['id']);
                $customers = $customerController->getCustomerList();

                echo '<form action="#" method="post">
                           <div class="form-group">
                            <label for="customer">Klant</label>
                                <select class="form-control" name="customernumber">
                                    <option value="'.$consignment['customernumber'].'">'.$consignment['customerfirstname']. ' ' .$consignment['customerlastname'].'</option>';

                foreach($customers as $customer){
                    if($consignment['customernumber'] != $customer['customernumber']) {
                        echo '<option value="' . $customer['customernumber'] . '">' . $customer['customerfirstname'] . ' ' . $customer['customerlastname'] . '</option>';
                    }
                }

                echo '                      </select>
                              </div>
                              <div class="form-group">
                                <label for="pickupstreet">Straat</label>
                                <input type="text" class="form-control" id="pickupstreet" name="pickupstreet" value="'.$consignment['pickupstreet'].'">
                              </div>
                              <div class="form-group">
                                <label for="pickuphousenumber">Huisnummer</label>
                                <input type="text" class="form-control" id="pickuphousenumber" name="pickuphousenumber" value="'.$consignment['pickuphousenumber'].'">
                              </div>
                              <div class="form-group">
                                <label for="pickuphousenumberaddon">Huisnummer toevoeging</label>
                                <input type="text" class="form-control" id="pickuphousenumberaddon" name="pickuphousenumberaddon" value="'.$consignment['pickuphousenumberaddon'].'">
                              </div>
                              <div class="form-group">
                                <label for="pickupzipcode">Postcode</label>
                                <input type="text" class="form-control" id="pickupzipcode" name="pickupzipcode" value="'.$consignment['pickupzipcode'].'">
                              </div>
                              <div class="form-group">
                                <label for="pickupcity">Stad</label>
                                <input type="text" class="form-control" id="pickupcity" name="pickupcity" value="'.$consignment['pickupcity'].'">
                              </div>
                              <div class="form-group">
                                <label for="consignorname">Getekend door</label>
                                <input type="text" class="form-control" id="consignorname" name="consignorname" value="'.$consignment['consignorname'].'">
                              </div>
                              <div class="form-group">
                                <label for="completedlabel">Afgerond</label><br/>
                                <label class="radio-inline">
                                  <input type="radio" name="completed" id="completed1" value="1" '.($consignment['completed'] == 1 ? 'checked' : '').'> Ja
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="completed" id="completed2" value="0" '.($consignment['completed'] == 0 ? 'checked' : '').'> Nee
                                </label>
                              </div>
                              <div class="form-group date">
                                <label for="scheduledpickup">Ophaaltijd</label>
                                <input type="text" class="form-control" id="scheduledpickup" name="scheduledpickup" value="'.$consignment['scheduledpickup'].'">
                              </div>
                              <div class="form-group date">
                                <label for="scheduleddelivery">Levertijd</label>
                                <input type="text" class="form-control" id="scheduleddelivery" name="scheduleddelivery" value="'.$consignment['scheduleddelivery'].'">
                              </div>
                              <div class="form-group date">
                                <label for="price">Prijs</label>
                                <div class="input-group">
                                    <span class="input-group-addon">&euro;</span>
                                    <input type="text" class="form-control" id="price" name="price" value="'.$consignment['price'].'">
                                </div>
                              </div>
                              <div class="form-group date">
                                <label for="totalprice">Totaal prijs</label>
                                <div class="input-group">
                                    <span class="input-group-addon">&euro;</span>
                                    <input type="text" class="form-control" id="totalprice" name="totalprice" value="'.$consignment['totalprice'].'">
                                </div>
                              </div>
                              <div class="form-group date">
                                <label for="comment">Commentaar</label>
                                <input type="text" class="form-control" id="comment" name="comment" value="'.$consignment['comment'].'">
                                <input type="hidden" class="form-control" id="consignmentnumber" name="consignmentnumber" value="'.$consignment['consignmentnumber'].'">
                              </div>
                              <button type="submit" name="changeConsignment" class="btn btn-primary">Save</button>
                        </form>';
            } else {
                echo 'U didnt give any consignmentnumber!';
            }
    echo '    </div>
          </div>';
