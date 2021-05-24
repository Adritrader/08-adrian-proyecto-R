<?php


namespace App\Controllers;


use App\Core\Controller;
use App\Core\Exception\ModelException;
use App\Core\Exception\NotFoundException;
use App\Model\ProductoModel;

use App\Core\App;

class ApiController extends Controller
{

    /**
     * @return string
     * @throws \App\Core\Exception\ModelException
     */

    public function index(): string
    {
        try {
            $productoModel = App::getModel(ProductoModel::class);
            $producto = $productoModel->findAll();
        } catch (ModelException $e) {

            echo $e->getMessage();

        }

        return $this->response->jsonResponse($producto);
    }

    /**
     * @return string
     * @throws \App\Core\Exception\NotFoundException
     */

    public function showProducto(int $id): string
    {
        try {
            $productoModel = App::getModel(ProductoModel::class);
            $producto = $productoModel->find($id);
        } catch (NotFoundException $e) {

            echo $e->getMessage();

        }

        return $this->response->jsonResponse2($producto);
    }

}