<?php

include_once('../Model/Employees.php');
include_once('../Model/EmployeesView.php');

$empView=new EmployeesView();
$empView->Show_AllEmployees();


?>