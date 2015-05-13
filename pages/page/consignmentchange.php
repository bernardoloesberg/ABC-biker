<?php
    include_once('code/controllers/ConsignmentController.php');

    $consignmentController = new ConsignmentController();

    echo '<div class="row">
            <div class="col-md-4">
                Menu
            </div>
            <div class="col-md-8">';

            if (isset($_GET['id'])) {
                $consignment = $consignmentController->getConsignment(mysql_real_escape_string($_GET['id']));

                echo '<form>
                          <div class="form-group">
                            <label for="consignmentnumber">Consignmentnumber</label>
                            <input type="text" class="form-control" id="consignmentnumber" value="'.$consignment['consignmentnumber'].'">
                          </div>
                          <div class="form-group">
                            <label for="customer">Customer</label>
                            <select class="form-control" name="customernumber">
                                <option value="'.$consignment['customernumber'].'">'.$consignment['customerfirstname']. ' ' .$consignment['customerlastname'].'</option>
                            </select>
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
                            <label for="deliverzipcode">Deliverzipcode</label>
                            <input type="text" class="form-control" id="deliverzipcode" name="deliverzipcode" value="'.$consignment['deliverzipcode'].'">
                          </div>
                          <div class="form-group">
                            <label for="pickupstreet">Pickupstreet</label>
                            <input type="text" class="form-control" id="pickupstreet" name="pickupstreet" value="'.$consignment['deliverstreet'].'">
                          </div>
                          <div class="form-group">
                            <label for="pickuphousenumber">Pickuphousenumber</label>
                            <input type="text" class="form-control" id="pickuphousenumber" value="'.$consignment['deliverhousenumber'].'">
                          </div>
                          <div class="form-group">
                            <label for="pickupzipcode">Pickupzipcode</label>
                            <input type="text" class="form-control" id="pickupzipcode" name="pickupzipcode" value="'.$consignment['deliverzipcode'].'">
                          </div>
                          <div class="form-group">
                            <label for="consignorname">Consignorname</label>
                            <input type="text" class="form-control" id="consignorname" name="consignorname" value="'.$consignment['consignorname'].'">
                          </div>
                          <button type="submit" class="btn btn-default">Save</button>
                        </form>';
            } else {
                echo 'U didnt give any consignmentnumber!';
            }
    echo '    </div>
          </div>';
