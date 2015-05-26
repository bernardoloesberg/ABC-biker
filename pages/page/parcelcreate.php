<?php
    include_once('code/controllers/ConsignmentController.php');

    /**
     * TODO: NEXT STEP ON CONSIGNMENT
     */
    if(isset($_POST['createConsignment'])){
        $consignmentController = new ConsignmentController();
        $result = $consignmentController->createConsignment($_POST);

        if($result){
            showMessage('success', 'U heeft een nieuwe consignment toegevoegd!');
        }else{
            showMessage('danger', 'Het toevoegen van een nieuwe consignment is mislukt!');
        }
        print_r($_POST);
    }

    echo '<div class="row">
            <div class="col-md-2">
                Menu
            </div>
            <div class="col-md-10">
                <form action="#" method="post">
                    <div class="form-group">
                        <label for="consignmentnumber">consignmentnumber</label>
                        <input type="text" class="form-control" id="consignmentnumber" name="consignmentnumber" value="" />
                    </div>
                    <div class="form-group">
                        <label for="pickupemployeenumber">pickupemployeenumber</label>
                        <input type="text" class="form-control" id="pickupemployeenumber" name="pickupemployeenumber" value="" />
                    </div>
                    <div class="form-group">
                        <label for="deliveremployeenumber">deliveremployeenumber</label>
                        <input type="text" class="form-control" id="deliveremployeenumber" name="deliveremployeenumber" value="" />
                    </div>
                    <div class="form-group">
                        <label for="addressnumber">addressnumber</label>
                        <input type="text" class="form-control" id="addressnumber" name="addressnumber" value="" />
                    </div>
                    <div class="form-group">
                        <label for="weigthingrams">weigthingrams</label>
                        <input type="text" class="form-control" id="weigthingrams" name="weigthingrams" value="" />
                    </div>
                    <div class="form-group date">
                        <label for="pickup">pickup</label>
                        <input type="text" class="form-control" id="pickup" name="pickup" value="" />
                    </div>
                    <div class="form-group date">
                        <label for="delivery">delivery</label>
                        <input type="text" class="form-control" id="delivery" name="delivery" value="" />
                    </div>
                    <div class="form-group date">
                        <label for="hqarrival">hqarrival</label>
                        <input type="text" class="form-control" id="hqarrival" name="hqarrival" value="" />
                    </div>
                    <div class="form-group date">
                        <label for="hqdeparture">hqdeparture</label>
                        <input type="text" class="form-control" id="hqdeparture" name="hqdeparture" value="" />
                    </div>
                    <div class="form-group date">
                        <label for="comment">comment</label>
                        <input type="text" class="form-control" id="comment" name="comment" value="" />
                    </div>
                    <button type="submit" name="createConsignment" class="btn btn-primary">Toevoegen</button>
                </form>
            </div>
        </div>';