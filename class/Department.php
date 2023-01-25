<?php

class Department // implements TableEditable
{
    private int $id;
    private string $dptName;

    /**
     * @param string $dptName
     * @param int|null $id
     * @throws Exception
     */
    public function __construct(string $dptName, int $id = null)
    {
        $this->dptName = $dptName;
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $mysqli = Db::connect();
        if (!isset($id)) {
            $stmt = $mysqli->prepare("INSERT INTO departments(id, dptname) VALUES (?, ?)");
            $stmt->bind_param("is", $id, $dptName);
            $stmt->execute();
            $this->id = $mysqli->insert_id;
        } else {
            $this->dptName = $dptName;
            $this->id = $id;
        }
    }

    /**
     * @param string $dptName
     * @return bool
     * @throws Exception
     */
    public static function exists(string $dptName): bool
    {
        $mysqli = Db::connect();
        $checkForDuplicates = "SELECT EXISTS(SELECT dptname FROM departments WHERE dptname = ?)";
        $stmt = $mysqli->prepare($checkForDuplicates);
        $stmt->bind_param("s", $dptName);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $dupe = false;
        foreach ($row as $x => $x_value) {
            $dupe = $x_value;
        }
        return $dupe;
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
    public function getDptName(): string
    {
        return $this->dptName;
    }

    /**
     * @param string $dptName
     */
    public function setDptName(string $dptName): void
    {
        $this->dptName = $dptName;
    }

    /**
     * @param int $id
     * @return void
     * @throws Exception
     */
    public static function deleteFromTable(int $id): void
    {
        $mysqli = Db::connect();
        $stmt = $mysqli->prepare("DELETE FROM departments WHERE id = (?)");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    /**
     * @param string $dptName
     * @return void
     * @throws Exception
     */
    public function updateTableEntry(string $dptName): void
    {
        $this->setDptName($dptName);
        $id = $this->getId();
        $mysqli = Db::connect();
        $stmt = $mysqli->prepare("UPDATE departments SET dptname = (?) WHERE id = (?)");
        $stmt->bind_param("si", $dptName, $id);
        $stmt->execute();
    }

    /**
     * @param int $id
     * @return Department
     * @throws Exception
     */
    public static function getById(int $id): Department
    {
        $mysqli = Db::connect();
        $sql = "SELECT id, dptname FROM departments WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return new Department($row['dptname'], $row['id']);
    }

    /**
     * @return array
     * @throws Exception
     */
    public static function getAll(): array
    {
        $sql = "SELECT id, dptname FROM departments ORDER BY id ASC";
        $mysqli = Db::connect();
        $result = $mysqli->query($sql);
        $readArr = [];
        while ($row = $result->fetch_assoc()) {
            $readArr[] = new Department($row['dptname'], $row['id']);
        }
        return $readArr;
    }

    /**
     * @param Employee|null $employee
     * @return string
     * @throws Exception
     */
    public static function getSelect(Employee $employee = null): string
    {
        $select = '';
        $departments = self::getAll();
        if (isset($employee)) {
            foreach ($departments as $department) {
                if ($employee->getDepartmentId() == $department->getId()) {
                    $select .= '<option value="' . $department->getId() . '" selected>' . $department->getDptName() . '</option>';
                } else {
                    $select .= '<option value="' . $department->getId() . '">' . $department->getDptName() . '</option>';
                }
            }
        } else {
            foreach ($departments as $department) {
                $select .= '<option value="' . $department->getId() . '">' . $department->getDptName() . '</option>';
            }
        }
        return $select;
    }

    /**
     * @return string
     * @throws Exception
     */
    public static function getTable(): string
    {
        $departments = Department::getAll();
        $html = '<h2>Abteilungen</h2>';
        $html .= '<table class="highlight striped">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th>ID</th>';
        $html .= '<th>Name</th>';
        $html .= '</thead>';
        $html .= '<tbody>';
        foreach ($departments as $department) {
            $currentId = $department->getId();
            $html .= '<tr>';
            $html .= '<td>' . $currentId . '</td>';
            $html .= '<td><input type="text" class="dptName" data-id="' . $currentId . '" value="' . $department->getDptName() . '" onchange="loadDpt(this)">' . '</td>';
            $html .= '<form action="index.php" method="post">';
            $html .= '<input type="hidden" name="area" value="department">';
//            $html .= '<td><button class="btn waves-effect waves-light" name="action" value="showUpdate' .
//                $currentId . '" type="submit" id="' . $currentId . '">Ändern</button></td>';
            $html .= '<td><button class="btn waves-effect waves-light" name="action" value="delete' .
                $currentId . '" type="submit" id="' . $currentId . '">Löschen</button></td>';
            $html .= '</form>';
        }
        $html .= '</tbody>';
        $html .= '</table>';

        return $html;
    }

    /**
     * @param Department|null $department
     * @return string
     */
    public static function getForm(Department $department = null): string
    {
        $html = '<form class="col s12" action="index.php" method="post">';
        $html .= '<input type="hidden" name="area" value="department">';
        $html .= '<div class="row">';
        $html .= '<div class="input-field col s6">';
        $html .= '<input id="dptname" type="text" class="validate" name="departmentName"';
        if (isset($department)) {
            $html .= 'value="' . $department->getDptName() . '"';
        }
        $html .= '">';
        $html .= '<label for="dptname">Bezeichnung</label>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="row">';
        if (!isset($department)) {
            $html .= '<button class="btn waves-effect waves-light" name="action" value="create" type="submit">
                Hinzufügen';
            $html .= '<i class="material-icons right">+</i>';
            $html .= '</button>';
        } else {
            $html .= '<button class="btn waves-effect waves-light" name="action" value="update' . $department->getId() . '" type="submit">
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