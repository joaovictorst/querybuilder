<?php

namespace App\Factories;

use PDO;

class PDOFactory
{
    private static PDO $pdo;

    public static function create(): PDO
    {
        if (!empty(self::$pdo)) {
            return self::$pdo;
        }

        $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=postgres;user=postgres;password=root");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$pdo = $pdo;

        echo "Conectado com sucesso!\n";

        return self::$pdo;
    }
}
