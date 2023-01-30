<?php

namespace Owlnext\NotificationAPI\Exception;

use Exception;
use Throwable;

class HttpException extends Exception
{

    public function __construct(string $message = "", int $httpStatus = 0, ?Throwable $previous = null)
    {
        $message = sprintf("[API HTTP %s]: %s", $httpStatus, $message);

        parent::__construct($message, 0, $previous);
    }

}