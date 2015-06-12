<?php
/**
 * Created by PhpStorm.
 * User: Christiaan
 */
if(
//isset($_SESSION['user']) && $_SESSION['user']['rolename'] == 'dispatcher'
true) {
    include_once('code/controllers/DistrictController.php');

    $districtController = new DistrictController();

    if (isset($_POST['changeDistrict'])) {
        $result = $districtController->changeDistrict($_POST);

        if ($result == 'success') {
            showMessage('success', 'U heeft een district gewijzigd!');
        } else {
            showMessage('danger', $result);
        }
    }

    echo '<div class="row">
            <div class="col-md-12">';

    if (isset($_GET['id'])) {
        $district = $districtController->getDistrict($_GET['id']);


        echo '    <form action="#" method="post">
                          <div class="form-group" style="display: none;">
                            <label for="districtnumber">Voornaam</label>
                            <input type="text" class="form-control" id="districtnumber" name="districtnumber" value="' . $district['districtnumber'] . '">
                          </div>
                          <div class="form-group">
                              <div class="col-md-4">
                                <label for="districtnaam">Districtnaam</label>
                                <input type="text" class="form-control" id="districtnaam" name="districtnaam" value="' . $district['districtname'] . '">
                              </div>
                          <button type="submit" class="btn btn-success" name="changeDistrict">Sla verandering op</button>
                        </form>';
    } else {
        echo 'Geen nummer meegegeven';
    }
    echo '    </div>
          </div>';
}
else{
    showMessage('danger', 'U heeft geen toegang tot deze pagina! Neem contact op met de beheerder.');
}