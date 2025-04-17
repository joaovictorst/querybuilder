<?php

namespace App\Database;

use App\Abstract\Query;

class Delete extends Query {

    protected $table = '';
    protected $columns = [];
    protected $values = [];

    public function from(array $table) {
        $this->table = $table;
        return $this;
    }

    public function getSQL()
    {
        $where = '';
        if (!empty($this->whereClause)) {
            $where = ' WHERE ' . implode(' AND ', $this->whereClause);
        }
    
        return "DELETE FROM {$this->table}{$where}";
    }
    
}