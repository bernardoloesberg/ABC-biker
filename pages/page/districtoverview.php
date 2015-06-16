<?php
/**
 * User: Christiaan
 */
include_once('code/controllers/DistrictController.php');

if(
//isset($_SESSION['user']) && $_SESSION['user']['rolename'] == 'dispatcher' || isset($_SESSION['user']) && $_SESSION['user']['rolename'] == 'manager'
    true){
    $districtController = new DistrictController();
    $districtList = $districtController->getDistrictList();

    echo '<div class="row">
                <div class="col-md-12">
                    <a class="btn btn-info" href="'.$_SESSION['rooturl'].'/districtcreate">Nieuw District</a></td>
                    <div class="input-group"> <span class="input-group-addon">Filter</span>
                         <input id="filter" type="text" class="form-control" placeholder="Type here...">
                    </div>
                    <table class="table">
                        <thead>
                            <th>Districtnummer</th>
                            <th>Districtnaam</th>
                            <th>Bewerken</th>
                            <th>Verwijderen</th>
                        </thead>
                        <tbody class="searchable">';

    foreach($districtList as $district){
        echo '<tr>
                 <td>'.$district['districtnumber'] . '</td>
                 <td>'.$district['districtname']. '</td>
                 <td><a class="btn btn-primary" href="'.$_SESSION['rooturl'].'/districtchange/'.$district['districtnumber'].'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></a></td>
                <td><button class="btn btn-danger deleteDistrict" name="deleteDistrict" value="'.$district['districtnumber'].'"><span class="glyphicon glyphicon-trash" aria-hidden="true"></button></td>
             </tr>';
    }

    echo                '</tbody>
                    </table>
                </div>
          </div>';

    loadscript('code/js/deleteHandlers.js');
    loadscript('code/js/filter.js');
}else{
    showMessage('danger', 'U heeft geen toegang tot deze pagina! Neem contact op met de beheerder.');
}
