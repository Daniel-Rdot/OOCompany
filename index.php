<?php
include 'config.php';
spl_autoload_register(function ($class) {
    include 'class/' . $class . '.php';
});
ini_set('display_errors', 1);

include 'view/homeNav.php';
$view = 'home';
$action = $_REQUEST['action'] ?? '';
$area = $_REQUEST['area'] ?? '';
$departmentName = $_POST['departmentName'] ?? '';
$firstName = $_POST['firstName'] ?? '';
$lastName = $_POST['lastName'] ?? '';
$sex = $_POST['sex'] ?? '';
$salary = $_POST['salary'] ?? '';
$departmentId = $_POST['departmentId'] ?? '';


include 'view/head.php';


if ($action === 'showRead') {
    if ($area === 'employee') {
        $view = 'showReadEmployee';
    } elseif ($area === 'department') {
        $view = 'showReadDepartment';
    }
} elseif ($action === 'showCreate') {
    if ($area === 'employee') {
        $view = 'showCreateEmployee';
    } elseif ($area === 'department') {
        $view = 'showCreateDepartment';
    }
} elseif (str_starts_with($action, 'showUpdate')) {
    if ($area === 'employee') {
        $view = 'showUpdateEmployee';
    } elseif ($area === 'department') {
        $view = 'showUpdateDepartment';
    }
} elseif ($action === 'create') {
    if ($area === 'employee') {
        new Employee($firstName, $lastName, $sex, $salary, $departmentId);
        $view = 'showReadEmployee';
    } elseif ($area === 'department') {
        new Department(($departmentName));
        $view = 'showReadDepartment';
    }
} elseif (str_starts_with($action, 'delete')) {
    if ($area === 'employee') {
        Employee::deleteFromTable(substr($action, 6));
        $view = 'showReadEmployee';
    } elseif ($area === 'department') {
        Department::deleteFromTable(substr($action, 6));
        $view = 'showReadDepartment';
    }
} elseif (str_starts_with($action, 'update')) {
    if ($area === 'employee') {
        $e = Employee::getById(substr($action, 6));
        $e->updateTableEntry($firstName, $lastName, $sex, $salary, $departmentId);
        $view = 'showReadEmployee';
    } elseif ($area === 'department') {
        $d = Department::getById(substr($action, 6));
        $d->updateTableEntry($departmentName);
        $view = 'showReadDepartment';
    }
}


include 'view/' . $view . '.php';
include 'view/foot.php';

echo '<pre>';
print_r($_REQUEST);
echo '</pre>';