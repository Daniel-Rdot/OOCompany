<?php

class Employee // implements TableEditable
{
    private static int $nextId = 1;
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $sex;
    private float $salary;
    private int $departmentId;


    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $sex
     * @param float $salary
     * @param int $departmentId
     * @param int|null $id
     */
    public function __construct(string $firstName, string $lastName, string $sex, float $salary, int $departmentId, int $id = null)
    {
        $mysqli = Db::connect();
        $sql = "INSERT INTO employees(id, firstname, lastname, sex, salary, department_id) VALUES (NULL, '$firstName', '$lastName', '$sex', $salary, $departmentId)";
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->sex = $sex;
        $this->salary = $salary;
        $this->departmentId = $departmentId;
        if (!isset($id)) {
            $this->id = self::$nextId;
            Employee::$nextId++;
            $mysqli->query($sql);
        } else {
            $this->id = $id;
        }
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getSex(): string
    {
        return $this->sex;
    }

    /**
     * @return float
     */
    public function getSalary(): float
    {
        return $this->salary;
    }

    /**
     * @return int
     */
    public function getDepartmentId(): int
    {
        return $this->departmentId;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @param float $salary
     */
    public function setSalary(float $salary): void
    {
        $this->salary = $salary;
    }

    /**
     * @param int $departmentId
     */
    public function setDepartmentId(int $departmentId): void
    {
        $this->departmentId = $departmentId;
    }

    /**
     * @param int $id
     * @return void
     */
    public static function deleteFromTable(int $id): void
    {
        $sql = "DELETE FROM employees WHERE id = $id";
        $mysqli = Db::connect();
        $mysqli->query($sql);
    }

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $sex
     * @param float $salary
     * @param int $departmentId
     * @param int $id
     * @return void
     */
    public function updateTableEntry(string $firstName, string $lastName, string $sex, float $salary, int $departmentId): void
    {
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->setSalary($salary);
        $this->setDepartmentId($departmentId);
        $id = $this->getId();
        $mysqli = Db::connect();
        $mysqli->query("UPDATE employees SET firstname = '$firstName', lastname = '$lastName', sex = '$sex', salary = $salary, department_id = $departmentId WHERE id = $id");
    }


    public static function getById(int $id): Employee
    {
        $mysqli = Db::connect();
        $sql = "SELECT id, firstname, lastname, sex, salary, department_id FROM employees WHERE id = $id";
        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();
        return new Employee($row['firstname'], $row['lastname'], $row['sex'], $row['salary'], $row['department_id'], $row['id']);
    }

    /**
     * @return array
     */
    public static function getAll(): array
    {
        $readArr = [];
//        try {
        $sql = "SELECT id, firstname, lastname, sex, salary, department_id FROM employees ORDER BY id ASC";
        $mysqli = Db::connect();
        $result = $mysqli->query($sql);

        while ($row = $result->fetch_assoc()) {
            $readArr[] = new Employee($row['firstname'], $row['lastname'], $row['sex'], $row['salary'], $row['department_id'], $row['id']);
        }
//        } catch (Error $e) {
//            echo $e->getMessage();
//        }
        return $readArr;
    }

    /**
     * @param string $firstName
     * @param string $lastName
     * @param $salary
     * @return bool
     */
    public static function checkInput(string $firstName, string $lastName, string $salary): array
    {
        $inputCheck = [];
        if (Employee::exists($firstName, $lastName)) {
            $inputCheck[] = 'duplicate';
        }
//        if (!Employee::inputNotEmpty($firstName, $lastName, $salary)) {
//            $inputCheck[] = 'empty';
//        }
        if (!is_numeric($salary)) {
            $inputCheck[] = 'salaryNotFloat';
        }
        return $inputCheck;
    }

    /**
     * @param string $firstName
     * @param string $lastName
     * @return bool
     * @throws Exception
     */
    public static function exists(string $firstName, string $lastName): bool
    {
        $mysqli = Db::connect();
        $checkForDuplicates = "SELECT EXISTS(SELECT firstname, lastname FROM employees WHERE firstname = '$firstName' AND lastname = '$lastName')";
        $result = $mysqli->query($checkForDuplicates);
        $row = $result->fetch_assoc();
        $dupe = false;
        foreach ($row as $x => $x_value) {
            $dupe = $x_value;
        }
        return $dupe;
    }

    /**
     * @param string $firstName
     * @param string $lastName
     * @param float $salary
     * @return bool
     */
    public static function inputNotEmpty(string $firstName, string $lastName, string $salary): bool
    {
        $arguments = func_get_args();
        foreach ($arguments as $argument) {
            if (empty($argument)) {
                return false;
            }
        }
        return true;
    }

    /**
     * @return void
     */

    public function insertIntoTable(): void
    {
        $mysqli = Db::connect();
        $sql = "INSERT INTO employees(id, firstname, lastname, sex, salary, department_id) VALUES (NULL, '$this->firstName', '$this->lastName', '$this->sex', $this->salary, $this->departmentId)";
        $mysqli->query($sql);
    }


    public static function getTable(): string
    {
        $employees = Employee::getAll();
        $html = '<h2>Mitarbeiter</h2>';
        $html .= '<table class="highlight striped">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th>ID</th>';
        $html .= '<th>Vorname</th>';
        $html .= '<th>Nachname</th>';
        $html .= '<th>Geschlecht</th>';
        $html .= '<th>Monatslohn</th>';
        $html .= '<th>Abteilung</th>';
        $html .= '</thead>';
        $html .= '<tbody>';
        foreach ($employees as $employee) {
            $currentId = $employee->getId();
            $html .= '<tr>';
            $html .= '<td>' . $employee->getId() . '</td>';
            $html .= '<td>' . $employee->getFirstName() . '</td>';
            $html .= '<td>' . $employee->getLastName() . '</td>';
            $html .= '<td>' . $employee->getSex() . '</td>';
            $html .= '<td>' . $employee->getSalary() . '</td>';
            $html .= '<td>' . Department::getById($employee->getDepartmentId())->getDptName() . '</td>';
            $html .= '<form action="index.php" method="post">';
            $html .= '<input type="hidden" name="area" value="employee">';
            $html .= '<td><button class="btn waves-effect waves-light" name="action" value="showUpdate' .
                $currentId . '" type="submit" id="' . $currentId . '">Ändern</button></td>';
            $html .= '<td><button class="btn waves-effect waves-light" name="action" value="delete' .
                $currentId . '" type="submit" id="' . $currentId . '">Löschen</button></td>';
            $html .= '</form>';
        }
        $html .= '</tbody>';
        $html .= '</table>';

        return $html;

    }

    public static function getForm(Employee $employee = null): string
    {
        $html = '<form class="col s12" action="index.php" method="post">';
        $html .= '<input type="hidden" name="area" value="employee">';
        $html .= '<div class="row">';
        $html .= '<div class="input-field col s6">';
        $html .= '<input id="first_name" type="text" class="validate" name="firstName"';
        if (isset($employee)) {
            $html .= 'value="' . $employee->getFirstName() . '"';
        }
//        $html .= '" required>';
        $html .= '">';
        $html .= '<label for="first_name">Vorname</label>';
        $html .= '</div>';
        $html .= '<div class="input-field col s6">';
        $html .= '<input id="last_name" type="text" class="validate" name="lastName"';
        if (isset($employee)) {
            $html .= 'value="' . $employee->getLastName() . '"';
        }
//        $html .= '" required>';
        $html .= '">';
        $html .= '<label for="last_name">Nachname</label>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="row">';
        $html .= '<div class="input-field col s6">';
        $html .= '<select id="sexDropdown" class="materialSelect" name="sex" required>';
        if (!isset($employee)) {
            $html .= '<option value="" disabled selected>Geschlecht auswählen</option>';
            $html .= '<option value="m">Männlich</option>';
            $html .= '<option value="w">Weiblich</option>';
        } else {
            if ($employee->getSex() === 'm') {
                $html .= '<option value="m" selected>Männlich</option>';
                $html .= '<option value="w">Weiblich</option>';
            } else {
                $html .= '<option value="w" selected>Weiblich</option>';
                $html .= '<option value="m">Männlich</option>';
            }
        }
        $html .= '</select>';
        $html .= '<label for="sexDropdown">Geschlecht</label>';
        $html .= '</div>';
        $html .= '<div class="input-field col s6">';
        $html .= '<input id="salary" type="text" class="validate" name="salary"';
        if (isset($employee)) {
            $html .= 'value="' . $employee->getSalary() . '"';
        }
//        $html .= '" required>';
        $html .= '">';
        $html .= '<label for="salary">Monatslohn</label>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="row">';
        $html .= '<div class="input-field col s6">';
        $html .= '<select id="dptDropdown" class="materialSelect" name="departmentId" required>';
        if (!isset($employee)) {
            $html .= '<option value="" disabled selected>Abteilung auswählen</option>';
            $html .= Department::getSelect();
        } else {
            $html .= Department::getSelect($employee);
        }
        $html .= '</select>';
        $html .= '<label for="dptDropdown">Abteilung</label>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="row">';
        if (!isset($employee)) {
            $html .= '<button class="btn waves-effect waves-light" name="action" value="create" type="submit">
                Hinzufügen';
            $html .= '<i class="material-icons right">+</i>';
            $html .= '</button>';
        } else {
            $html .= '<button class="btn waves-effect waves-light" name="action" value="update' . $employee->getId() . '" type="submit">
                Ändern';
            $html .= '<i class="material-icons right">+</i>';

            $html .= '</button>';
        }
        $html .= '</div>';
        $html .= '</form>';
        $html .= '</div>';

        return $html;
    }

}