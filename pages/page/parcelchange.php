    <?php
    include_once('code/controllers/ConsignmentController.php');
    include_once('code/controllers/ParcelController.php');
    include_once('code/controllers/EmployeeController.php');

    $emloyeeController = new EmployeeController();
    $parcelController = new ParcelController();
    $employees = $emloyeeController->getEmployeeList();

    if(isset($_GET['id'])){
        $parcel = $parcelController->getParcel($_GET['id']);

        if(isset($_POST['changeParcel'])){
            print_r($_POST);
            $result = $parcelController->changeParcel($_POST);

            $parcel = $parcelController->getParcel($_GET['id']);
        }

        echo '<div class="row">
                <div class="col-md-2">
                    Menu
                </div>
                <div class="col-md-10">
                    <form action="'.$_SESSION['rooturl'].'/parcelchange/'.$_GET['id'].'" method="post">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="customer">Opgehaald door:</label>
                                <select class="form-control" name="pickupemployeenumber" id="pickupemployeenumber">
                                    <option value="'.$parcel['pickupemployeenumber'].'">'.$parcel['pickupemployeefirstname'].' '. $parcel['pickupemployeelastname'] .'</option>';
        foreach($employees as $employee){
            if($employee['employeenumber'] != $parcel['pickupemployeenumber']) {
                echo '<option value="' . $employee['employeenumber'] . '">' . $employee['employeefirstname'] . ' ' . $employee['employeelastname'] . '</option>';
            }
        }

        echo                   '</select>
                            </div>
                            <div class="col-md-6">
                                <label for="customer">Bezorgt door:</label>
                                <select class="form-control" name="deliveremployeenumber" id="deliveremployeenumber">
                                    <option value="'.$parcel['deliveremployeenumber'].'">'.$parcel['deliveremployeefirstname'].' '. $parcel['deliveremployeelastname'] .'</option>';

        foreach($employees as $employee){
            if($employee['employeenumber'] != $parcel['deliveremployeenumber']) {
                echo '<option value="' . $employee['employeenumber'] . '">' . $employee['employeefirstname'] . ' ' . $employee['employeelastname'] . '</option>';
            }
        }

        echo                   '</select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <label for="pickupstreet">Straat</label>
                                <input type="text" class="form-control" id="pickupstreet" name="pickupstreet" value="'.$parcel['street'].'">
                            </div>
                            <div class="col-md-4">
                                <label for="pickuphousenumber">Huisnummer</label>
                                <input type="text" class="form-control" id="pickuphousenumber" name="pickuphousenumber" value="'.$parcel['housenumber'].'">
                            </div>
                            <div class="col-md-4">
                                <label for="pickuphousenumberaddon">Huisnummer toevoeging</label>
                                <input type="text" class="form-control" id="pickuphousenumberaddon" name="pickuphousenumberaddon" value="'.$parcel['housenumberaddon'].'">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pickupzipcode">Postcode</label>
                                    <input type="text" class="form-control" id="pickupzipcode" name="pickupzipcode" value="'.$parcel['zipcode'].'">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pickupcity">Woonplaats</label>
                                    <input type="text" class="form-control" id="pickupcity" name="pickupcity" value="'.$parcel['city'].'">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="weigthingrams">weigthingrams</label>
                                    <input type="text" class="form-control" id="weigthingrams" name="weigthingrams" value="'.$parcel['weightingrams'].'" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="pickup">Opgehaald om</label>
                                <input type="text" class="form-control" id="pickup" name="pickup" value="'.$parcel['pickup'].'" />
                            </div>
                            <div class="col-md-6">
                                <label for="delivery">Bezorgt om</label>
                                <input type="text" class="form-control" id="delivery" name="delivery" value="'.$parcel['delivery'].'" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="hqarrival">Aangekomen HQ</label>
                                <input type="text" class="form-control" id="hqarrival" name="hqarrival" value="'.$parcel['hqarrival'].'" />
                            </div>
                            <div class="col-md-6">
                                <label for="hqdeparture">Verlaten HQ</label>
                                <input type="text" class="form-control" id="hqdeparture" name="hqdeparture" value="'.$parcel['hqdeparture'].'" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                            <label for="comment">comment</label>
                            <input type="text" class="form-control" id="comment" name="comment" value="'.$parcel['comment'].'" />
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="changeParcel" class="btn btn-primary">Toevoegen</button>
                            <input type="hidden" value="'.$parcel['parcelnumber'].'" name="parcelnumber" />
                            <input type="hidden" value="'.$parcel['consignmentnumber'].'" name="consignmentnumber" />
                        </div>
                    </form>
                </div>
            </div>';
    }else{
        echo 'U heeft geen pakketnummer opgegeven!';
    }