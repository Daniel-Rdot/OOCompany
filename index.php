<?php
include 'view/head.php';
include 'view/receiveAndSanitize.php';
include 'view/homeNav.php';
$view = 'home';
$inputWarning = [];


try {
    if ($action === 'showRead') {
        $view = 'showRead' . ucfirst($area);
    } elseif ($action === 'showCreate') {
        $view = 'showCreate' . ucfirst($area);
    } elseif (str_starts_with($action, 'showUpdate')) {
        $view = 'showUpdate' . ucfirst($area);
    } elseif ($action === 'create') {
        if ($area === 'employee') {
            $inputFields = [$firstName, $lastName, $salary];
            if (inputHandler::inputNotEmpty($inputFields)) {
                if (!Employee::exists($firstName, $lastName)) {
                    if (is_numeric($salary)) {
                        $salary = (float)$salary;
                        new Employee($firstName, $lastName, $sex, $salary, $departmentId);
                        $view = 'showRead' . ucfirst($area);
                    } else {
                        $inputWarning[] = 'salaryNotFloat';
                        include 'view/inputWarnings.php';
                        $view = 'showCreate' . ucfirst($area);
                        $inputWarning = [];
                    }
                } else {
                    $inputWarning[] = 'duplicate';
                    include 'view/inputWarnings.php';
                    $view = 'showCreate' . ucfirst($area);
                    $inputWarning = [];
                }
            } else {
                $inputWarning[] = 'empty';
                include 'view/inputWarnings.php';
                $view = 'showCreate' . ucfirst($area);
                $inputWarning = [];
            }
        } elseif ($area === 'department') {
            $inputFields = [$departmentName];
            if (inputHandler::inputNotEmpty($inputFields)) {
                if (!Department::exists($departmentName)) {
                    new Department($departmentName);
                    $view = 'showRead' . ucfirst($area);
                } else {
                    $inputWarning = ['duplicate'];
                    include 'view/inputWarnings.php';
                    $view = 'showCreate' . ucfirst($area);
                    $inputWarning = [];
                }
            } else {
                $inputWarning = ['empty'];
                include 'view/inputWarnings.php';
                $view = 'showCreate' . ucfirst($area);
            }
        }
    } elseif (str_starts_with($action, 'delete')) {
        if ($area === 'employee') {
            Employee::deleteFromTable(substr($action, 6));
            $view = 'showRead' . ucfirst($area);
        } elseif ($area === 'department') {
            Department::deleteFromTable(substr($action, 6));
            $view = 'showRead' . ucfirst($area);
        }
    } elseif (str_starts_with($action, 'update')) {
        if ($area === 'employee') {
            $e = Employee::getById(substr($action, 6));
            if (!Employee::exists($firstName, $lastName)) {
                $e->updateTableEntry($firstName, $lastName, $salary, $departmentId);
                $view = 'showRead' . ucfirst($area);
            } else {
                $inputWarning = ['duplicate'];
                include 'view/inputWarnings.php';
                $action = 'showUpdate' . $e->getId();
                $view = 'showUpdate' . ucfirst($area);
                $inputWarning = [];
            }
        } elseif ($area === 'department') {
            $d = Department::getById(substr($action, 6));
            if (!Department::exists($departmentName)) {
                $d->updateTableEntry($departmentName);
                $view = 'showRead' . ucfirst($area);
            } else {
                $inputWarning = ['duplicate'];
                include 'view/inputWarnings.php';
                $action = 'showUpdate' . $d->getId();
                $view = 'showUpdate' . ucfirst($area);
                $inputWarning = [];
            }
        }
    } else {
        $view = 'home';
    }
    include 'view/' . $view . '.php';
    include 'view/foot.php';
} catch (Exception $e) {
    file_put_contents('log/error.log', $e->getMessage() . ' ' . $e->getLine() . "\n" . $e->getFile() .
        ' ' . $e->getCode() . ' ' . $e->getTraceAsString() . ' ' . Date('Y-m-d H:i:s') . "\n" .
        file_get_contents('log/error.log'));
    include 'view/error.php';
} catch (Error $e) {
    file_put_contents('log/error.log', $e->getMessage() . ' ' . $e->getLine() . "\n" . $e->getFile() .
        ' ' . $e->getCode() . ' ' . $e->getTraceAsString() . ' ' . Date('Y-m-d H:i:s') . "\n" .
        file_get_contents('log/error.log'));
    include 'view/error.php';
}


