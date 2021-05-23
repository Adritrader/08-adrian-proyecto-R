<?php


namespace App\Entity;

use App\Core\Entity;
use JsonSerializable;

class Contiene implements Entity, JsonSerializable {

    private ?int $id = null;
    private int $producto_id;
    private int $pedido_id;

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
    public function getProductoId()
    {
        return $this->producto_id;
    }

    /**
     * @param mixed $producto_id
     */
    public function setProductoId($producto_id): void
    {
        $this->producto_id = $producto_id;
    }

    /**
     * @return mixed
     */
    public function getPedidoId()
    {
        return $this->pedido_id;
    }

    /**
     * @param mixed $pedido_id
     */
    public function setPedidoId($pedido_id): void
    {
        $this->pedido_id = $pedido_id;
    }

    public function toArray(): array
    {
        return [

            "id"=>$this->getId(),
            "pedido_id"=>$this->getPedidoId(),
            "producto_id"=>$this->getProductoId()
        ];
    }

    public function jsonSerialize() {

        return $this->toArray();

    }
}