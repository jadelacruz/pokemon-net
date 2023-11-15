<?php

namespace App\Exceptions\User;

use Exception;

/**
 * class EmailTakenException
 * @package App\Exceptions\User
 */
class EmailTakenException extends Exception
{
    /**
     * @var int
     */
    public $code = 422;

    /**
     * @var string
     */
    public $message = 'The email address is taken already, please try again.';
}
