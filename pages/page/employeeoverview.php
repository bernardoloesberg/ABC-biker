<?php
include_once('code/controllers/EmployeeController.php');

$employeeController = new EmployeeController();
$employeeList = $employeeController->getEmployeeList();

//print_r($employeeList);

echo '<div class="row">
                <div class="col-md-4">

                </div>
                <div class="col-md-8">
                    <table class="table">
                        <thead>
                            <th>number</th>
                            <th>name</th>
                            <th>bsn</th>
                            <th>cellphone</th>
                            <th>Bewerken</th>
                            <th>Verwijderen</th>
                        </thead>
                        <tbody>';

foreach($employeeList as $employee){
    echo '<tr>
                 <td>'.$employee['employeenumber'].'</td>
                 <td>'.$employee['employeefirstname'] . ' ' . $employee['employeelastname'].'</td>
                 <td>'.$employee['bsn']. '</td>
                 <td>'.$employee['cellphone']. '</td>
                 <td><a href="'.$_SESSION['rooturl'].'/employeechange/'.$employee['employeenumber'].'">Bewerken</a></td>
                 <td><a href="'.$_SESSION['rooturl'].'/employeedelete/'.$employee['employeenumber'].'">Verwijderen</a></td>
             </tr>';
}

echo                '</tbody>
                    </table>
                </div>
          </div>';