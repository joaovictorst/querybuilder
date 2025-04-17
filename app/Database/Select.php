<?php


namespace App\Database;

use App\Abstract\Query;


class Select extends Query {
    const STAR = '*';

    public function from(array $table, array $columns = [Select::STAR]){
        $this->columns = $columns;
        $this->table($table);
    }


    public function getSQL(){
        $table = $this->table;
        $columns = implode(", ", $this->columns);;
        $where = $this->where;

        
        $sql = [];
        $sql = "SELECT {$columns} FROM {$table}";
        
        return $sql;
    }

}