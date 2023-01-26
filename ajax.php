<?php
include 'view/receiveAndSanitize.php';

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
    $sex = $obj->getSex();
    $salary = $obj->getSalary();
    $departmentId = $obj->getDepartmentId();
    if (inputHandler::inputNotEmpty([$val])) {
        ${$attr} = inputHandler::getSanitized($val, ENT_QUOTES, 'UTF-8');
    }
    $obj->updateTableEntry($firstName, $lastName, $sex, (float)$salary, (int)$departmentId);
}

