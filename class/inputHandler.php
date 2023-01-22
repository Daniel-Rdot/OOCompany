<?php

class inputHandler
{
    /**
     * @param $data
     * @return string
     */
    public static function getSanitized($data): string
    {
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    }

    /**
     * @param array $inputFields
     * @return bool
     */
    public static function inputNotEmpty(array $inputFields): bool
    {
        foreach ($inputFields as $field) {
            if (!isset($field) or $field === '') {
                return false;
            }
        }
        return true;
    }
}