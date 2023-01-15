<?php

interface TableEditable
{
    public static function getAll();

    public static function getById($id);

    public function insertIntoTable();

    public function deleteFromTable($id);

    public function updateTableEntry();
}