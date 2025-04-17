<?php

namespace App\Abstract;

use App\Factories\PDOFactory;
use App\Utils\Utils;
use PDO;
use PDOException;

abstract class Query
{
    private ?PDO $pdo = null;

    protected $table;
    protected $columns = [];
    protected $where = [];
    protected $whereClause = [];
    protected $orderBy = '';
    protected $limit = '';
    protected $stmt;
    protected array $parameters = [];
    protected $values = [];

    public function __construct(?\PDO $PDO = null)
    {
        if (empty($PDO)) {
            $this->pdo = PDOFactory::create();
        }
        $this->pdo = $PDO;
    }

    public function table($table)
    {
        if (empty($table)) {
            $this->table = $table;
            return $this;
        }
        if (is_array($table)) {
            foreach ($table as $key => $value) {
                $this->table = $value;
                return $this;
            }
        }
        $this->table = $table;
        return $this;
    }

    public function where(array $conditions)
    {
        foreach ($conditions as $column => $value) {
            $paramName = ':' . $column;
            $this->whereClause[] = "$column = $paramName";
            $this->storeParameter($paramName, $value);
        }
        return $this;
    }


    protected function storeParameter(string $name, mixed $value): void
    {
        $this->parameters[$name] = Utils::formatValue($value);
    }

    abstract public function getSQL();

    public function execute()
    {
        $query = $this->getSQL();

        ### bindvalue VV
        foreach ($this->parameters as $paramName => $value) {
            $query = str_replace($paramName, $value, $query);
        }
        // var_dump($query);
        $stmt = $this->pdo->prepare($query);
        $this->stmt = $stmt;

        if(!empty($this->stmt)){
            try{
                $this->stmt->execute();
                return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            catch(PDOException $e){
                echo "<p> ERRO : " . $e->getMessage() . "</p>";
            }
        }

        return $this->stmt;
    }
}
