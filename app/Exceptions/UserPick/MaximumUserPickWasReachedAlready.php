<?php

namespace App\Exceptions\UserPick;

use Exception;

/**
 * class MaximumUserPickWasReachedAlready
 * @package App\Exceptions\UserPick
 */
class MaximumUserPickWasReachedAlready extends Exception
{
    /**
     * @var int
     */
    public $code = 400;

    /**
     * @var string
     */
    public $message = 'You have reached maximum number pick for this.';
}
