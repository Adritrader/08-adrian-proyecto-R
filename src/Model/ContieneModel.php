<?php
declare(strict_types=1);

namespace App\Model;


use App\Core\Model;
use App\Entity\Contiene;
use PDO;

class ContieneModel extends Model
{
    public function __construct(PDO $pdo, string $tableName = "contienepro", string $className = Contiene::class)
    {
        parent::__construct($pdo, $tableName, $className);
    }
}