<?php
declare(strict_types=1);

namespace App\Model;


use App\Core\Model;
use App\Entity\Realiza;
use PDO;

class RealizaModel extends Model
{
    public function __construct(PDO $pdo, string $tableName = "realiza", string $className = Realiza::class)
    {
        parent::__construct($pdo, $tableName, $className);
    }
}