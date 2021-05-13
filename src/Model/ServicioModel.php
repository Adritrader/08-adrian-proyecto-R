<?php
declare(strict_types=1);

namespace App\Model;


use App\Core\Model;
use App\Entity\Servicio;
use PDO;

class ServicioModel extends Model
{
    public function __construct(PDO $pdo, string $tableName = "servicio", string $className = Servicio::class)
    {
        parent::__construct($pdo, $tableName, $className);
    }
}