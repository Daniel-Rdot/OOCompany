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
        $sql = "INSERT INTO employees(id, firstname, lastname, sex, salary, department_id) VALUES (NULL, '$$firstName', '$lastName', '$sex', $salary, $departmentId)";
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
    function deleteFromTable(int $id): void
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
    public function updateTableEntry(string $firstName, string $lastName, string $sex, float $salary, int $departmentId, int $id): void
    {
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
        $sql = "SELECT id, firstname, lastname, sex, salary, department_id FROM employees ORDER BY id ASC";
        $mysqli = Db::connect();
        $result = $mysqli->query($sql);
        $readArr = [];
        while ($row = $result->fetch_assoc()) {
            $readArr[] = new Employee($row['firstname'], $row['lastname'], $row['sex'], $row['salary'], $row['department_id'], $row['id']);
        }
        return $readArr;
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
        $html = '<table>';
        foreach ($employees as $employee) {
            $html .= '<tr>';
            $html .= '<td>' . $employee->getId() . '</td>';
            $html .= '<td>' . $employee->getFirstName() . '</td>';
            $html .= '<td>' . $employee->getLastName() . '</td>';
            $html .= '<td>' . $employee->getGender() . '</td>';
            $html .= '<td>' . $employee->getSalary() . '</td>';
            $html .= '<td>' . Department::getById($employee->getDepartmentId())->getName() . '</td>';
            $html .= '<td><button type="button" class="showUpdate" id="update' . $employee->getId() . '">Update</button></td>';
            $html .= '<td><button type="button" class="delete" id="delete' . $employee->getId() . '">Löschen</button></td>';
            $html .= '</tr>';
        }
        $html .= '</table>';

        return $html;

    }

}