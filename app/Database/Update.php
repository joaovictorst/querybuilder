<?php

namespace App\Database;

use App\Abstract\Query;
use App\Utils\Utils;

class Update extends Query {

    private $set = [];

    public function table($table)
    {
        $this->$table = $table;
    }

    public function set(string|array $column, $value = null){
        if(is_array($column)){
            foreach ($column as $col => $val) {
                $this->set($col, $val);
            }
        }
        if(is_string($column)){
            if(is_int($column) || is_numeric($column)){
                throw new \InvalidArgumentException("ARGUMENTO INVALIDO, A COLUNA DEVE SER UMA STRING");
            }
            
            $paramName = ":$column";
            $this->set[$column] = $paramName;
            $this->storeParameter($paramName, $value);

        }
        echo "<pre>";
        var_dump($this->parameters);
        var_dump($this->set);
        echo "</pre>";

    }

    public function getSQL()
    {
        
    }
}