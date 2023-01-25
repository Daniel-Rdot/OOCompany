<?php
include 'config.php';
spl_autoload_register(function ($class) {
    include 'class/' . $class . '.php';
});

ini_set('display_errors', 1);
$area = $_POST['area'];
$id = $_POST['id'];
$attr = $_POST['data-attr'];
$val = $_POST['value'];

if ($area === 'department') {
    $dptName = inputHandler::getSanitized($_POST['dptName'], ENT_QUOTES, 'UTF-8');
    $obj = Department::getById($id);
    if (inputHandler::inputNotEmpty([$dptName])) {
        $obj->updateTableEntry($dptName);
    }
} elseif ($area === 'employee') {
    $obj = Employee::getById($id);
    $firstName = $obj->getFirstName();
    $lastName = $obj->getLastName();
    $salary = $obj->getSalary();
    $departmentId = $obj->getDepartmentId();
    if (inputHandler::inputNotEmpty([$val])) {
        ${$attr} = inputHandler::getSanitized($val, ENT_QUOTES, 'UTF-8');
    }
    $obj->updateTableEntry($firstName, $lastName, (float)$salary, (int)$departmentId);
}

