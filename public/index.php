<?php

// use Ilias\Maestro\Database\Select;

use App\Database\Delete;
use App\Factories\PDOFactory;
use Ilias\Maestro\Core\Maestro;
use App\Database\Insert;

use App\Database\Select;
use App\Database\Update;

require __DIR__ . '/../vendor/autoload.php';

$connection = PDOFactory::create();

### para dar INSERT é assim:

// $insert = new Insert($connection);
// $insert->into("usuario")
//         ->values(['nome' => "MARCOSCH'UPAROLA",
//                 'email' =>'marcusChupaarola@example.com',
//                 'senha' => 'kuzindealicate']);
// echo "<pre>";
// $insert->execute();
// echo "</pre>";

### para dar SELECT é assim :

// $select = new Select($connection);
// $select->from(['u' => 'usuario']);
// // var_dump($select->getSQL());

// echo "<pre>";
// print_r($select->execute());
// echo "</pre>";


$delete = new Delete($connection);

$delete->table("usuario")->where(["id" => 51]);

echo "<pre>";
var_dump($delete->getSQL());
var_dump($delete->execute());
echo "</pre>";


// $update = new Update($connection);

// $update->set('name',143543435);

?>