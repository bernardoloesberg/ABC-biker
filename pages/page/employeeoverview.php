<?php
include_once('code/controllers/EmployeeController.php');

$employeeController = new EmployeeController();
$employeeList = $employeeController->getEmployeeList();

//print_r($employeeList);

if(isset($_POST['deleteEmployee'])){
    $result = $employeeController->deleteEmployee($_POST);

    if($result){
        showMessage('succes', 'U heeft een nieuwe employee verwijderd!');
    }else{
        showMessage('danger', 'Het verwijderen van een nieuwe employee is mislukt!');
    }
}

echo '<div class="row">
                <div class="col-md-4">

                </div>
                <div class="col-md-8">
                    <a class="btn btn-info" href="'.$_SESSION['rooturl'].'/employeecreate">Nieuwe employee</a></td>
                    <form action="#" method="post">
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
                 <td><a class="btn btn-primary" href="'.$_SESSION['rooturl'].'/employeechange/'.$employee['employeenumber'].'">Bewerken</a></td>
                <td><button class="btn btn-danger deleteConsignment" name="deleteEmployee" value="'.$employee['employeenumber'].'">Verwijderen</button></td>
             </tr>';
}

echo                '</tbody>
                    </table>
                    </form>
                </div>
          </div>';