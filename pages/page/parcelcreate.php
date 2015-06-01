<?php
    include_once('code/controllers/ConsignmentController.php');
    include_once('code/controllers/ParcelController.php');
    include_once('code/controllers/EmployeeController.php');

    $emloyeeController = new EmployeeController();
    $consignmentController = new ConsignmentController();

    $employees = $emloyeeController->getEmployeeList();

    echo '<form action="'.$_SESSION['rooturl'].'/consignmentoverview" method="post">';

    if(isset($_GET['id'])){
        echo '<input type="hidden" name="consignmentnumber" id="consignmentnumber" value="'.$_GET['id'].'" />';
    }

    /**
     * TODO: NEXT STEP ON CONSIGNMENT
     */
    if(isset($_POST['createConsignment'])){
        $consignmentID = $consignmentController->createConsignment($_POST);

        if($consignmentID){
            showMessage('success', 'U heeft een nieuwe consignment toegevoegd!'. $consignmentID);

            echo '<input type="hidden" name="consignmentnumber" id="consignmentnumber" value="'.$consignmentID.'" />';
        }else{
            showMessage('danger', 'Het toevoegen van een nieuwe consignment is mislukt!');
        }
    }

    echo '<div class="row">
            <div class="col-md-2">
                Menu
            </div>
            <div class="col-md-10">
                    <div class="form-group">
                        <div class="col-md-6">
                            <label for="customer">Opgehaald door:</label>
                            <select class="form-control" name="pickupemployeenumber" id="pickupemployeenumber">';
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
                            <input type="text" class="form-control" id="pickupstreet" name="pickupstreet" value="">
                        </div>
                        <div class="col-md-4">
                            <label for="pickuphousenumber">Huisnummer</label>
                            <input type="text" class="form-control" id="pickuphousenumber" name="pickuphousenumber" value="">
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
                                <input type="text" class="form-control" id="pickupzipcode" name="pickupzipcode" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pickupcity">Woonplaats</label>
                                <input type="text" class="form-control" id="pickupcity" name="pickupcity" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="weigthingrams">weigthingrams</label>
                                <input type="text" class="form-control" id="weigthingrams" name="weigthingrams" value="" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
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
                    </div>
                    <div class="form-group">
                        <button type="submit" name="createParcel" class="btn btn-primary">Toevoegen</button>
                    </div>
                </form>
            </div>
        </div>';