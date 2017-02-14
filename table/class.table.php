<?php

namespace table;

class table
{
    protected function select_from ($table, $field, $value)
    {
        $row = db()->select_row (
            "SELECT *
               FROM " . $table . " 
              WHERE " . $field . " = '" . addslashes($value) .
           "' LIMIT 1");
        if (!$row) return false;
        foreach ($row as $name => $value)
            $this->$name = $value;
        return true;
    }

}
