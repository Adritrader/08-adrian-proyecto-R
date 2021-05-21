<?php

namespace App\Core\Exception;

use Throwable;

class NotFoundException extends AppException
{
public function __construct($message = "Not found exception", $code = 404, Throwable $previous = null)
{
    parent::__construct($message, $code, $previous);
}

}