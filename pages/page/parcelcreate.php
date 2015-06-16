<?php
    include_once('code/controllers/ConsignmentController.php');
    include_once('code/controllers/ParcelController.php');
    include_once('code/controllers/EmployeeController.php');
if(isset($_SESSION['user']) && $_SESSION['user']['rolename'] == 'dispatcher'){
    $emloyeeController = new EmployeeController();
    $consignmentController = new ConsignmentController();

    $employees = $emloyeeController->getEmployeeList();

    if(isset($_GET['id'])){
        echo '<form action="'.$_SESSION['rooturl'].'/consignmentdetail/'.$_GET['id'].'" method="post">
              <input type="hidden" name="consignmentnumber" id="consignmentnumber" value="'.$_GET['id'].'" />';
    }else{
        echo '<form action="'.$_SESSION['rooturl'].'/consignmentoverview/" method="post">';
    }

    echo '<div class="row">
            <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-md-6">
                            <label for="customer">Opgehaald door:</label>
                            <select class="form-control" name="pickupemployeenumber" id="pickupemployeenumber" required>';
    foreach($employees as $employee){
        echo '<option value="'.$employee['employeenumber'].'">'.$employee['employeefirstname'].' '. $employee['employeelastname'] .'</option>';
    }

    echo                   '</select>
                        </div>
                        <div class="col-md-6">
                            <label for="customer">Bezorgt door:</label>
                            <select class="form-control" name="deliveremployeenumber" id="deliveremployeenumber">';

    foreach($employees as $employee){
        echo '<option value="'.$employee['employeenumber'].'">'.$employee['employeefirstname'].' '. $employee['employeelastname'] .'</option>';
    }

    echo                   '</select>
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
                            <div class="form-group">
                                <label for="pickupzipcode">Postcode</label>
                                <input type="text" class="form-control" id="pickupzipcode" name="pickupzipcode" value="" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pickupcity">Woonplaats</label>
                                <input type="text" class="form-control" id="pickupcity" name="pickupcity" value="" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="weigthingrams">Gewicht</label>
                                <input type="text" class="form-control" id="weigthingrams" name="weigthingrams" value="" required>
                            </div>
                        </div>
                    </div>

                    <!--<div class="form-group">
                        <div class="col-md-6">
                            <label for="pickup">Opgehaald om</label>
                            <input type="text" class="form-control" id="pickup" name="pickup" value="" />
                        </div>
                        <div class="col-md-6">
                            <label for="delivery">Bezorgt om</label>
                            <input type="text" class="form-control" id="delivery" name="delivery" value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label for="hqarrival">Aangekomen HQ</label>
                            <input type="text" class="form-control" id="hqarrival" name="hqarrival" value="" />
                        </div>
                        <div class="col-md-6">
                            <label for="hqdeparture">Verlaten HQ</label>
                            <input type="text" class="form-control" id="hqdeparture" name="hqdeparture" value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                        <label for="comment">comment</label>
                        <input type="text" class="form-control" id="comment" name="comment" value="" />
                        </div>
                    </div>-->
                    <div class="form-group">
                            <div class="col-md-6">
                                <label for="hqarrival">Prijs</label>
                                <input type="text" class="form-control" id="price" name="price" value="'.$parcel['price'].'" />
                            </div>
                            <div class="col-md-6">
                                <label for="dispatcher">Express</label>
                                  <span class="input-group-addon">
                                    <input type="checkbox" class="" name="express" value="1">
                                  </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                            <button type="submit" name="createParcel" class="btn btn-primary">Toevoegen</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>';
}else{
    showMessage('danger', 'U heeft geen toegang tot deze pagina! Neem contact op met de beheerder.');
}