<?php
    /**
     * Created by PhpStorm.
     * User: Bernardo
     */
    include_once('code/controllers/ConsignmentController.php');
    include_once('code/controllers/CustomerController.php');

if(isset($_SESSION['user']) && $_SESSION['user']['rolename'] == 'dispatcher'){
    $consignmentController = new ConsignmentController();
    $customerController = new CustomerController();

    if(isset($_POST['createConsignment'])){
        $consignmentID = $consignmentController->createConsignment($_POST);

        if($consignmentID){
            showMessage('success', 'U heeft een nieuwe consignment toegevoegd!');

            echo '<input type="hidden" name="consignmentnumber" id="consignmentnumber" value="'.$consignmentID.'" />';
        }else{
            showMessage('danger', 'Het toevoegen van een nieuwe consignment is mislukt!');
        }
    }

    $customers = $customerController->getCustomerList();
    echo '<div class="row">
                <div class="col-md-12">
                        <form action="#" method="post">
                              <div class="form-group">
                              <div class="col-md-12">
                                <label for="customer">Klant</label>
                                <select class="form-control" name="customernumber" id="customerChange" required>
                                    <option value=""></option>';


foreach($customers as $customer){
    echo '<option value="'.$customer['customernumber'].'">'.$customer['customerfirstname']. ' ' .$customer['customerlastname'].'</option>';
}
    echo '                      </select>
                               </div>
                              </div>
                              <div class="form-group">
                                <div class="col-md-4">
                                    <label for="pickupstreet">Straat</label>
                                    <input type="text" class="form-control" id="pickupstreet" name="pickupstreet" value="" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="pickuphousenumber">Huisnummer</label>
                                    <input type="text" class="form-control" id="pickuphousenumber" name="pickuphousenumber" value="" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="pickuphousenumberaddon">Huisnummer toevoeging</label>
                                    <input type="text" class="form-control" id="pickuphousenumberaddon" name="pickuphousenumberaddon" value="">
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-md-4">
                                    <label for="pickupzipcode">Postcode</label>
                                    <input type="text" class="form-control" id="pickupzipcode" name="pickupzipcode" value="" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="pickupcity">Woonplaats</label>
                                    <input type="text" class="form-control" id="pickupcity" name="pickupcity" value="" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="consignorname">Totaal prijs</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">&euro;</span>
                                        <input type="text" class="form-control" id="totalprice" name="totalprice" value="">
                                    </div>
                                </div>
                              </div>
                              <!--<div class="form-group">
                                <div class="col-md-4">
                                    <label for="consignorname">Prijs</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">&euro;</span>
                                        <input type="text" class="form-control" id="price" name="price" value="0" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="consignorname">Ophaaltijd</label>
                                    <input type="datetime-local" class="form-control" id="scheduledpickup" name="scheduledpickup" >
                                </div>
                                <div class="col-md-4">
                                    <label for="consignorname">Aflevertijd</label>
                                    <input type="time" class="form-control" id="scheduleddelivery" name="scheduleddelivery" value="">
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-md-6">
                                    <label for="consignorname">Getekend door</label>
                                    <input type="text" class="form-control" id="consignorname" name="consignorname" value="">
                                </div>
                              </div>-->
                              <div class="form-group">
                                  <div class="col-md-12">
                                    <button type="submit" name="createConsignment" class="btn btn-primary">Toevoegen</button>
                                  </div>
                              </div>
                            </form>
                    </div>
              </div>';

        loadscript('code/js/changeHandler.js');
}else{
    showMessage('danger', 'U heeft geen toegang tot deze pagina! Neem contact op met de beheerder.');
}
