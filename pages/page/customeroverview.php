<?php
    include_once('code/controllers/CustomerController.php');

    $CustomerController = new CustomerController();
    $CustomerList = $CustomerController->getCustomerList();

if(isset($_SESSION['user']) && $_SESSION['user']['rolename'] == 'dispatcher' || isset($_SESSION['user']) && $_SESSION['user']['rolename'] == 'manager'){
    echo '<div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <th>Klantnummner</th>
                            <th>Klantnaam</th>
                            <th>Bedrijfsnaam</th>
                            <th>Bekijken</th>
                            <th>Bewerken</th>
                            <th>Verwijderen</th>
                        </thead>
                        <tbody>';

    foreach($CustomerList as $customer) {
        echo '<tr>
                 <td>'.$customer['customernumber'].'</td>
                 <td>'.$customer['customerfirstname'] . ' ' . $customer['customerlastname'].'</td>
                 <td>'.$customer['companyname']. '</td>
                 <td><a class="btn btn-info" href="'.$_SESSION['rooturl'].'/customerdetail/'.$customer['customernumber'].'"><span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></a></td>
                 <td><a class="btn btn-primary" href="'.$_SESSION['rooturl'].'/customerchange/'.$customer['customernumber'].'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></a></td>
                 <td><button class="btn btn-danger deleteCustomer" value="'.$customer['customernumber'].'"><span class="glyphicon glyphicon-trash" aria-hidden="true"></button></td>
             </tr>';
    }

    echo                '</tbody>
                    </table>
                </div>
          </div>';

loadscript('code/js/deleteHandlers.js');
}else{
    showMessage('danger', 'U heeft geen toegang tot deze pagina! Neem contact op met de beheerder.');
}
