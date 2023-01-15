<?php

class Department // implements TableEditable
{
    private static int $nextId = 1;
    private int $id;
    private string $dptName;


    /**
     * @param string $dptName
     * @param int|null $id
     */
    public function __construct(string $dptName, int $id = null)
    {
        $mysqli = Db::connect();
        $sql = "INSERT INTO departments(id, dptname) VALUES (NULL, '$dptName')";
        $this->dptName = $dptName;
        if (!isset($id)) {
            $this->id = self::$nextId;
            Department::$nextId++;
            $mysqli->query($sql);
        } else {
            $this->id = $id;
        }
    }

    /**
     * @return int
     */
    public static function getNextId(): int
    {
        return self::$nextId;
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
     */
    function deleteFromTable(int $id): void
    {
        $sql = "DELETE FROM departments WHERE id = $id";
        $mysqli = Db::connect();
        $mysqli->query($sql);
    }

    /**
     * @param string $dptName
     * @param $id
     * @return void
     */
    public function updateTableEntry(string $dptName, $id): void
    {
        $mysqli = Db::connect();
        $sql = "UPDATE departments SET dptname = '$dptName' WHERE id = $id";
        $mysqli->query($sql);
    }

    /**
     * @param int $id
     * @return Department
     */
    public static function getById(int $id): Department
    {
        $mysqli = Db::connect();
        $sql = "SELECT id, dptname FROM departments WHERE id = $id";
        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();
        return new Department($row['dptname'], $row['id']);
    }

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
     * @return string
     */
    public static function getSelect(): string
    {
        $select = '';
        $departments = self::getAll();
        foreach ($departments as $department) {
            $select .= '<option value="' . $department->getId() . '">' . $department->getDptName() . '</option>';
        }
        return $select;
    }
}