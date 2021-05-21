<?php


namespace App\Core\Exception;

use Exception;
use Throwable;


class AuthorizationException extends Exception
{

    public function __construct($message = "Not found exception", $code = 403, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
