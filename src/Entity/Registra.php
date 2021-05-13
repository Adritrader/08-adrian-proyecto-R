<?php


namespace App\Entity;


use App\Core\Entity;
use JsonSerializable;
use DateTime;

class Registra implements Entity, JsonSerializable {

    private ?int $id = null;
    private int $USUARIO_id;
    private int $SERVICIO_id;
    private DateTime $horaCita;
    private DateTime $fechaCita;

    public function __set(string $name, $value)
    {
        switch ($name) {
            case "hora":
                $this->horaCita = DateTime::createFromFormat("H:i:s", $value);
                break;
            case "fecha":
                $this->fechaCita = DateTime::createFromFormat("Y-m-d", $value);
                break;
        }
    }

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
     * @return int
     */
    public function getUSUARIOId(): int
    {
        return $this->USUARIO_id;
    }

    /**
     * @param int $USUARIO_id
     */
    public function setUSUARIOId(int $USUARIO_id): void
    {
        $this->USUARIO_id = $USUARIO_id;
    }

    /**
     * @return int
     */
    public function getSERVICIOId(): int
    {
        return $this->SERVICIO_id;
    }

    /**
     * @param int $SERVICIO_id
     */
    public function setSERVICIOId(int $SERVICIO_id): void
    {
        $this->SERVICIO_id = $SERVICIO_id;
    }

    /**
     * @return mixed
     */
    public function getHoraCita()
    {
        return $this->horaCita;
    }

    /**
     * @param mixed $horaCita
     */
    public function setHoraCita($horaCita): void
    {
        $this->horaCita = $horaCita;
    }

    /**
     * @return mixed
     */
    public function getFechaCita()
    {
        return $this->fechaCita;
    }

    /**
     * @param mixed $fechaCita
     */
    public function setFechaCita($fechaCita): void
    {
        $this->fechaCita = $fechaCita;
    }





    public function toArray(): array
    {
        return [
            "id"=>$this->getId(),
            "USUARIO_id"=>$this->getUsuarioId(),
            "SERVICIO_id"=>$this->getServicioId(),
            "hora"=>$this->getHoraCita()->format("H:i:s"),
            "fecha"=>$this->getFechaCita()->format("Y-m-d")
        ];
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }


}