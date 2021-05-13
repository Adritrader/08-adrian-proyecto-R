<?php
declare(strict_types=1);

namespace App\Entity;


use App\Core\Entity;
use JsonSerializable;

class Producto implements Entity, JsonSerializable {

    const IMAGEN_PATH = 'images/design/productos/';

    private ?int $id = null;
    private string $nombre;
    private string $categoria;
    private string $descripcion;
    private int $precio;
    private string $imagen;

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

    /**
     * @return mixed
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @param mixed $categoria
     */
    public function setCategoria($categoria): void
    {
        $this->categoria = $categoria;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion): void
    {
        $this->descripcion = $descripcion;
    }



    /**
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @param mixed $precio
     */
    public function setPrecio($precio): void
    {
        $this->precio = $precio;
    }

    /**
     * @return string
     */
    public function getImagen(): string
    {
        return $this->imagen;
    }

    /**
     * @param string $imagen
     */
    public function setImagen(string $imagen): void
    {
        $this->imagen = $imagen;
    }




    public function toArray(): array
    {
        return [
            "id"=>$this->getId(),
            "nombre"=>$this->getNombre(),
            "categoria"=>$this->getCategoria(),
            "descripcion"=>$this->getDescripcion(),
            "precio"=>$this->getPrecio(),
            "imagen"=>$this->getImagen()
        ];
    }

    public function jsonSerialize()
    {

        return $this->toArray();
    }


}