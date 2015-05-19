<?php
    include_once('code/controllers/ConsignmentController.php');
    include_once('code/controllers/CustomerController.php');

    $consignmentController = new ConsignmentController();
    $customerController = new CustomerController();

    if(isset($_POST['changeConsignment'])){
        print_r($_POST);

    }

    echo '<div class="row">
            <div class="col-md-4">
                Menu
            </div>
            <div class="col-md-8">';

            if (isset($_GET['id'])) {
                $consignment = $consignmentController->getConsignment($_GET['id']);
                $customers = $customerController->getCustomerList();

                echo '<form action="#" method="post">
                          <div class="form-group">
                            <label for="consignmentnumber">Consignmentnumber</label>
                            <input type="text" class="form-control" id="consignmentnumber" value="'.$consignment['consignmentnumber'].'">
                          </div>
                          <div class="form-group">
                            <label for="customer">Customer</label>
                            <select class="form-control" name="customernumber">
                                <option value="'.$consignment['customernumber'].'">'.$consignment['customerfirstname']. ' ' .$consignment['customerlastname'].'</option>';

                foreach($customers as $customer){
                    echo '<option value="'.$customer['customernumber'].'">'.$customer['customerfirstname']. ' ' .$customer['customerlastname'].'</option>';
                }

                echo '      </select>
                          </div>
                          <div class="form-group">
                            <label for="deliverstreet">Deliverstreet</label>
                            <input type="text" class="form-control" id="deliverstreet" name="deliverstreet" value="'.$consignment['deliverstreet'].'">
                          </div>
                          <div class="form-group">
                            <label for="deliverhousenumber">Deliverhousenumber</label>
                            <input type="text" class="form-control" id="deliverhousenumber" name="deliverhousenumber" value="'.$consignment['deliverhousenumber'].'">
                          </div>
                          <div class="form-group">
                            <label for="deliverhousenumber">Deliverhousenumberaddon</label>
                            <input type="text" class="form-control" id="deliverhousenumberaddon" name="deliverhousenumberaddon" value="'.$consignment['deliverhousenumberaddon'].'">
                          </div>
                          <div class="form-group">
                            <label for="deliverzipcode">Deliverzipcode</label>
                            <input type="text" class="form-control" id="deliverzipcode" name="deliverzipcode" value="'.$consignment['deliverzipcode'].'">
                          </div>
                          <div class="form-group">
                            <label for="deliverzipcode">Delivercity</label>
                            <input type="text" class="form-control" id="deliverzipcode" name="delivercity" value="'.$consignment['delivercity'].'">
                          </div>
                          <div class="form-group">
                            <label for="pickupstreet">Pickupstreet</label>
                            <input type="text" class="form-control" id="pickupstreet" name="pickupstreet" value="'.$consignment['pickupstreet'].'">
                          </div>
                          <div class="form-group">
                            <label for="pickuphousenumber">Pickuphousenumber</label>
                            <input type="text" class="form-control" id="pickuphousenumber" name="pickuphousenumber" value="'.$consignment['pickuphousenumber'].'">
                          </div>
                          <div class="form-group">
                            <label for="deliverhousenumber">Pickuphousenumberaddon</label>
                            <input type="text" class="form-control" id="pickuphousenumberaddon" name="pickuphousenumberaddon" value="'.$consignment['pickuphousenumberaddon'].'">
                          </div>
                          <div class="form-group">
                            <label for="pickupzipcode">Pickupzipcode</label>
                            <input type="text" class="form-control" id="pickupzipcode" name="pickupzipcode" value="'.$consignment['pickupzipcode'].'">
                          </div>
                          <div class="form-group">
                            <label for="pickupzipcode">Pickupcity</label>
                            <input type="text" class="form-control" id="pickupzipcode" name="pickupzipcode" value="'.$consignment['pickupcity'].'">
                          </div>
                          <div class="form-group">
                            <label for="consignorname">Consignorname</label>
                            <input type="text" class="form-control" id="consignorname" name="consignorname" value="'.$consignment['consignorname'].'">
                          </div>
                          <button type="submit" class="btn btn-default" name="changeConsignment">Save</button>
                        </form>';
            } else {
                echo 'U didnt give any consignmentnumber!';
            }
    echo '    </div>
          </div>';
