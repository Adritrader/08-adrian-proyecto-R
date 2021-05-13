<?php
declare(strict_types=1);

namespace App\Entity;


use App\Core\Entity;
use JsonSerializable;

class Servicio implements Entity, JsonSerializable {

    private ?int $id = null;
    private string $nombre;

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    public function toArray(): array
    {
        return [
            "id"=>$this->getId(),
            "nombre"=>$this->getNombre()
        ];
    }

    public function jsonSerialize()
    {

        return $this->toArray();
    }

}