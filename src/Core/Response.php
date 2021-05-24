<?php
declare(strict_types=1);


namespace App\Core;


use App\Entity\Producto;


class Response
{
    /**
     * @param string $view
     * @param string $layout
     * @param array $data
     * @return string
     */
    public function renderView(string $view, string $layout = 'my', array $data = []): string {

        //var_dump($data);
        extract($data);


        ob_start();
        require __DIR__ . "/../../views/$view.view.php";
        $content = ob_get_clean();

        ob_start();
        require __DIR__ . "/../../views/_layouts/$layout.layout.php";

        return ob_get_clean();
    }

    /**
     * @param mixed $element
     * @return string
     */
    public function jsonResponse(array $element): string
    {
        header('Content-Type: application/json; charset=UTF-8');
        return json_encode($element);

    }

    /**
     * @param mixed $element
     * @return string
     */
    public function jsonResponse2(Producto $element): string
    {
        header('Content-Type: application/json; charset=UTF-8');
        return json_encode($element);

    }
}