<?php
    include_once('code/controllers/ConsignmentController.php');
    include_once('code/controllers/CustomerController.php');

    $consignmentController = new ConsignmentController();
    $customerController = new CustomerController();

    $customers = $customerController->getCustomerList();

    if(isset($_POST['submit'])){
        echo 'submit';
    }

    echo '<div class="row">
                <div class="col-md-4">
                    Menu
                </div>
                <div class="col-md-8">
                              <div class="form-group">
                                <label for="customer">Customer</label>
                                <select class="form-control" name="customernumber">';

    foreach($customers as $customer){
        echo '<option value="'.$customer['customernumber'].'">'.$customer['customerfirstname']. ' ' .$customer['customerlastname'].'</option>';
    }

    echo '                      </select>
                              </div>
                              <div class="form-group">
                                <label for="deliverstreet">Deliverstreet</label>
                                <input type="text" class="form-control" id="deliverstreet" name="deliverstreet" value="">
                              </div>
                              <div class="form-group">
                                <label for="deliverhousenumber">Deliverhousenumber</label>
                                <input type="text" class="form-control" id="deliverhousenumber" name="deliverhousenumber" value="">
                              </div>
                              <div class="form-group">
                                <label for="deliverzipcode">Deliverzipcode</label>
                                <input type="text" class="form-control" id="deliverzipcode" name="deliverzipcode" value="">
                              </div>
                              <div class="form-group">
                                <label for="delivercity">Delivercity</label>
                                <input type="text" class="form-control" id="delivercity" name="delivercity" value="">
                              </div>
                              <div class="form-group">
                                <label for="pickupstreet">Pickupstreet</label>
                                <input type="text" class="form-control" id="pickupstreet" name="pickupstreet" value="">
                              </div>
                              <div class="form-group">
                                <label for="pickuphousenumber">Pickuphousenumber</label>
                                <input type="text" class="form-control" id="pickuphousenumber" value="">
                              </div>
                              <div class="form-group">
                                <label for="pickupzipcode">Pickupzipcode</label>
                                <input type="text" class="form-control" id="pickupzipcode" name="pickupzipcode" value="">
                              </div>
                              <div class="form-group">
                                <label for="pickupcity">Pickupcity</label>
                                <input type="text" class="form-control" id="pickupcity" name="pickupcity" value="">
                              </div>
                              <div class="form-group">
                                <label for="consignorname">Consignorname</label>
                                <input type="text" class="form-control" id="consignorname" name="consignorname" value="">
                              </div>
                              <button type="submit" class="btn btn-default">Create</button>
                            </form>
                    </div>
              </div>';
