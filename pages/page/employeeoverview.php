<?php
include_once('code/controllers/EmployeeController.php');

if(isset($_SESSION['user']) && $_SESSION['user']['rolename'] == 'dispatcher' || isset($_SESSION['user']) && $_SESSION['user']['rolename'] == 'manager'){
$employeeController = new EmployeeController();
$employeeList = $employeeController->getEmployeeList();

//print_r($employeeList);

echo '<div class="row">
                <div class="col-md-12">
                    <a class="btn btn-info" href="'.$_SESSION['rooturl'].'/employeecreate">Nieuwe werknemer</a></td>
                    <div class="input-group"> <span class="input-group-addon">Filter</span>
                         <input id="filter" type="text" class="form-control" placeholder="Type here...">
                    </div>
                    <table class="table">
                        <thead>
                            <th>Naam</th>
                            <th>BSN-nummer</th>
                            <th>Telefoon</th>
                            <th>Bekijken</th>
                            <th>Bewerken</th>
                            <th>Verwijderen</th>
                        </thead>
                        <tbody class="searchable">';

foreach($employeeList as $employee){
    echo '<tr>
                 <td>'.$employee['employeefirstname'] . ' ' . $employee['employeelastname'].'</td>
                 <td>'.$employee['bsn']. '</td>
                 <td>'.$employee['cellphone']. '</td>
                 <td><a class="btn btn-info" href="'.$_SESSION['rooturl'].'/employeedetails/'.$employee['employeenumber'].'"><span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></a></td>
                 <td><a class="btn btn-primary" href="'.$_SESSION['rooturl'].'/employeechange/'.$employee['employeenumber'].'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></a></td>
                <td><button class="btn btn-danger deleteEmployee" name="deleteEmployee" value="'.$employee['employeenumber'].'"><span class="glyphicon glyphicon-trash" aria-hidden="true"></button></td>
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
