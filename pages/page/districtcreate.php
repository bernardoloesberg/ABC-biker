<?php
/**
 * Created by PhpStorm.
 * User: Christiaan
 */
include_once('code/controllers/DistrictController.php');

if(//isset($_SESSION['user']) && $_SESSION['user']['rolename'] == 'dispatcher'
true){
    $districtController = new DistrictController();

    if(isset($_POST['createDistrict'])){
        $result = $districtController->createDistrict($_POST);

        if($result == 'success'){
            showMessage('success', 'U heeft een nieuw district toegevoegd!');
        }else{
            showMessage('danger',$result);
        }
    }

    echo '<div class="row">
            <div class="col-md-12">
                           <form action="#" method="post">
                           <div class="form-group">
                            <div class="col-md-4">
                                <label for="Districtnaam">Districtnaam</label>
                                <input type="text" class="form-control" id="districtnaam" name="districtnaam" value="">
                            </div>
                          <button type="submit" name="createDistrict" class="btn btn-primary">Create</button>
                        </form>
                </div>
          </div>';
}else{
    showMessage('danger', 'U heeft geen toegang tot deze pagina! Neem contact op met de beheerder.');
}