<?php

namespace App\Database;

use App\Abstract\Query;

class Insert extends Query
{

    protected $table = '';
    protected $columns = [];


    public function into(string $table)
    {
        $this->table = $table;
        return $this;
    }

    public function values(array $data)
    {
        foreach ((array) $data as $column => $value) {
            $this->registerValue($column, $value);
        }
        return $this;
    }

    private function registerValue($column, $value)
    {
        $this->columns[] = $column;

        $paramName = ":$column";
        $this->storeParameter($paramName, $value);
        $this->values[] = $paramName;
        //$this->values[] =  $value;
    }

    public function getSQL()
    {
        $sql = [];
        if (!empty($this->table) && !empty($this->columns) && !empty($this->values)) {

            $sql[] = "INSERT INTO " . $this->table;
            $sql[] = "(" . implode(", ", $this->columns) . ")";
            $sql[] = "VALUES (" . implode(",", $this->values) . ")";
        }
        return implode(" ", $sql);
    }
}
