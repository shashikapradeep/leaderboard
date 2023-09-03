<?php

namespace Leaderboard\Exceptions;

use League\OAuth2\Server\Exception\OAuthServerException;
use \Exception;
use Throwable;

/**
 * Class oAuthValidationException
 * @package Leaderboard\Exceptions
 */
class oAuthValidationException extends Exception
{

    /**
     * @var array
     */
    protected $errorText = [
        401 => "Invalid Login Credentials."
    ];

    /**
     * oAuthValidationException constructor.
     * @param OAuthServerException $OAuthServerException
     */
    public function __construct(OAuthServerException $OAuthServerException)
    {
        $code = $OAuthServerException->getHttpStatusCode();
        parent::__construct($this->_getErrorMessage($code), $code, $OAuthServerException);
    }

    /**
     * @param int $code
     * @return mixed|null
     */
    private function _getErrorMessage($code = 0){
        return isset($this->errorText[$code]) ? $this->errorText[$code] : null;
    }
}
