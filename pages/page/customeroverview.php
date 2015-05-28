<?php
    include_once('code/controllers/CustomerController.php');

    $CustomerController = new CustomerController();
    $CustomerList = $CustomerController->getCustomerList();

    echo '<div class="row">
                <div class="col-md-4">

                </div>
                <div class="col-md-8">
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
                 <td><a class="btn btn-info" href="'.$_SESSION['rooturl'].'/customerdetail/'.$customer['customernumber'].'">Bekijken</a></td>
                 <td><a class="btn btn-primary" href="'.$_SESSION['rooturl'].'/customerchange/'.$customer['customernumber'].'">Bewerken</a></td>
                 <td><button class="btn btn-danger deleteCustomer" value="'.$customer['customernumber'].'">Verwijderen</button></td>
             </tr>';
    }

    echo                '</tbody>
                    </table>
                </div>
          </div>';

loadscript('code/js/deleteHandlers.js');