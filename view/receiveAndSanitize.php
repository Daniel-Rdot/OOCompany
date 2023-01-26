<?php
include 'config.php';
spl_autoload_register(function ($class) {
    include 'class/' . $class . '.php';
});

ini_set('display_errors', 1);


$action = inputHandler::getSanitized($_REQUEST['action'] ?? '', ENT_QUOTES, 'UTF-8');
$area = inputHandler::getSanitized($_REQUEST['area'] ?? '', ENT_QUOTES, 'UTF-8');
$id = filter_var($_POST['id'] ?? '', FILTER_SANITIZE_NUMBER_INT);
$departmentName = inputHandler::getSanitized($_POST['departmentName'] ?? '', ENT_QUOTES, 'UTF-8');
$firstName = inputHandler::getSanitized($_POST['firstName'] ?? '', ENT_QUOTES, 'UTF-8');
$lastName = inputHandler::getSanitized($_POST['lastName'] ?? '', ENT_QUOTES, 'UTF-8');
$sex = inputHandler::getSanitized($_POST['sex'] ?? '', ENT_QUOTES, 'UTF-8');
$salary = filter_var($_POST['salary'] ?? '', FILTER_SANITIZE_NUMBER_FLOAT);
$departmentId = filter_var($_POST['departmentId'] ?? '', FILTER_SANITIZE_NUMBER_INT);
$attr = inputHandler::getSanitized($_POST['data-attr'] ?? '', ENT_QUOTES, 'UTF-8');
$val = inputHandler::getSanitized($_POST['value'] ?? '', ENT_QUOTES, 'UTF-8');