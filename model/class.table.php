<?php

class table
{
    protected $row;

    public function __construct()
    {
    }

    public function get_row()
    {
        return $this->row;
    }

    public function set_row_field($field, $value)
    {
        $this->row [$field] = $value;
    }

    public function set_row($row)
    {
        foreach ($row as $field => $value)
            $this->row[$field] = $value;
    }

}