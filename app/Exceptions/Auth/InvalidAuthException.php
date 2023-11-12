<?php

namespace App\Exceptions\Auth;

use Exception;

/**
 * class InvalidAuthException
 * @package App\Exceptions\Auth
 */
class InvalidAuthException extends Exception
{
    /**
     * @var int
     */
    public $code = 401;

    /**
     * @var string
     */
    public $message = 'Invalid credentials';
}
