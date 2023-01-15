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


if ($action === 'showReadEmployee') {
    $view = 'showReadEmployee';
} elseif ($action === 'showReadDepartment') {
    $view = 'showReadDepartment';
}

if ($action === 'showCreate') {
    if ($area === 'employee') {
        $view = 'showCreateEmployee';
    } elseif ($area === 'department') {
        $view = 'showCreateDepartment';
    }
} elseif ($action === 'showUpdate') {
    if ($area === 'employee') {
        $view = 'showUpdateEmployee';
    } elseif ($area === 'department') {
        $view = 'showUpdateDepartment';
    }
}


if ($action === 'createEmployee') {
    new Employee($firstName, $lastName, $sex, $salary, $departmentId);
    $view = 'showReadEmployee';
}
if ($action === 'createDepartment') {
    new Department(($departmentName));
    $view = 'showReadDepartment';
}

include 'view/' . $view . '.php';
include 'view/foot.php';

echo '<pre>';
print_r($_REQUEST);
echo '</pre>';