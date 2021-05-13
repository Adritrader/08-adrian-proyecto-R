<?php


namespace App\Entity;


use App\Core\Entity;
use JsonSerializable;

class Realiza implements Entity, JsonSerializable {

    private ?int $id = null;
    private int $USUARIO_id;

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
    public function getUSUARIOId()
    {
        return $this->USUARIO_id;
    }

    /**
     * @param mixed $USUARIO_id
     */
    public function setUSUARIOId($USUARIO_id): void
    {
        $this->USUARIO_id = $USUARIO_id;
    }



    public function toArray(): array
    {
        return [
            "id"=>$this->getId(),
            "USUARIO_id"=>$this->getUSUARIOId()
        ];
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }


}