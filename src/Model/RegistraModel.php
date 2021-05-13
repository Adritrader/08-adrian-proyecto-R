<?php
declare(strict_types=1);

namespace App\Model;


use App\Core\Exception\ModelException;
use App\Core\Exception\NotFoundException;
use App\Core\Model;
use App\Entity\Registra;
use App\Entity\Servicio;
use App\Entity\Usuario;
use PDO;

class RegistraModel extends Model
{
    public function __construct(PDO $pdo, string $tableName = "registra", string $className = Registra::class)
    {
        parent::__construct($pdo, $tableName, $className);
    }

    public function saveTransaction(Registra $registra)
    {
        $fnSaveTransaction = function () use ($registra) {
            $this->save($registra);
        };
        $this->executeTransaction($fnSaveTransaction);
    }


    public function getNombre(int $id): Usuario {
        $usuarioModel = new UsuarioModel($this->pdo);
        try {
            $usuario = $usuarioModel->find($id);
        } catch (NotFoundException $e) {
            throw new ModelException($e->getMessage());
        }
        return $usuario;
    }

    public function getServicio(int $id): Servicio {
        $servicioModel = new ServicioModel($this->pdo);
        try {
            $servicio = $servicioModel->find($id);
        } catch (NotFoundException $e) {
            throw new ModelException($e->getMessage());
        }
        return $servicio;
    }
}