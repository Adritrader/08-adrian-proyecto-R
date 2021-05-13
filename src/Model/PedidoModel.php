<?php
declare(strict_types=1);

namespace App\Model;


use App\Core\Model;
use App\Entity\Pedido;
use PDO;

class PedidoModel extends Model
{
    public function __construct(PDO $pdo, string $tableName = "pedido", string $className = Pedido::class)
    {
        parent::__construct($pdo, $tableName, $className);

    }
}