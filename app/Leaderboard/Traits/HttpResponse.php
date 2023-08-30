<?php

namespace App\Leaderboard\Traits;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use InvalidArgumentException;
use SimpleXMLElement;

/**
 * Trait HttpResponse
 * @package CareHero\Traits
 */
trait HttpResponse
{

    /**
     * @var string
     */
    public string $version;

    /**
     * @var int
     */
    protected int $statusCode = 200;

    /**
     * @var string
     */
    protected string $statusText;

    /**
     * @var array
     */
    protected array $parameters = [];

    /**
     * @var array
     */
    protected array $httpHeaders = [];

    /**
     * @var array
     */
    public static array $statusTexts = [
        200 => 'OK',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not Found',
        408 => 'Request Timeout',
        422 => 'Mandatory fields should be validated',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
    ];


    /**
     * @return array
     */
    public function getDefaultHttpHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'X-CareHero-Version' => config('CareHero.api_ver'),
        ];
    }

    /**
     * Send API Response
     * @param mixed $data
     * @param string $message
     * @param int $statusCode
     * @param array $headers
     *
     * @return JsonResponse
     */
    public function sendResponse(mixed $data = null, string $message = 'OK', int $statusCode = 200, array $headers = []): JsonResponse
    {
        $this->setStatusCode($statusCode);
        $this->addHttpHeaders($headers);

        return Response()->json([
            'status_code' => $this->getStatusCode(),
            'status' => $this->getStatusText(),
            'message' => $message,
            'timestamp' => Carbon::now()->toDateTimeString(),
            'result' => $data
        ], $statusCode, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)->withHeaders($this->getHttpHeaders());
    }


    /**
     * Send Error response
     * @param null $data
     * @param string $message
     * @param int $statusCode
     * @param array $headers
     * @param string|null $statusText
     * @param string|null $debug
     *
     * @return JsonResponse
     */
    public function sendErrorResponse(mixed $data = null, string $message = 'ERROR', int $statusCode = 400, array $headers = [], string $statusText = null, string $debug = null): JsonResponse
    {
        $this->setStatusCode($statusCode, $statusText);
        $this->addHttpHeaders($headers);

        $errorObject = [
            'status_code' => $this->getStatusCode(),
            'status' => $this->getStatusText(),
            'message' => $message,
            'result' => $data
        ];

        if ($debug) {
            $errorObject['debug'] = $debug;
        }

        return Response()->json($errorObject, $statusCode)->withHeaders($this->getHttpHeaders());
    }

    /**
     * Send Exception
     * @param Exception $exception
     * @param int $statusCode
     * @param array $headers
     * @param string $message
     * @param array|null $data
     * @return JsonResponse
     */
    public function sendException(\Exception $exception, int $statusCode = 400, array $headers = [], string $message = 'Error', array $data = null): JsonResponse
    {
        $statusCode = $exception->getCode();
        $message = $exception->getMessage();

        $this->setStatusCode($statusCode);
        $this->addHttpHeaders($headers);

        return Response()->json([
            'status_code' => $this->getStatusCode(),
            'status' => $this->getStatusText(),
            'message' => $message,
            'result' => $data
        ], $statusCode)->withHeaders($this->getHttpHeaders());
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     * @param string|null $text
     */
    public function setStatusCode(int $statusCode, string $text = null): void
    {
        $this->statusCode = (int)$statusCode;
        if ($this->isInvalid()) {
            throw new InvalidArgumentException(sprintf('The HTTP status code "%s" is not valid.', $statusCode));
        }

        $this->statusText = false === $text ? '' : (null === $text ? self::$statusTexts[$this->statusCode] : $text);
    }

    /**
     * @return string
     */
    public function getStatusText(): string
    {
        return $this->statusText;
    }


    /**
     * @param array $httpHeaders
     */
    public function setHttpHeaders(array $httpHeaders): void
    {
        $this->httpHeaders = $httpHeaders;
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function setHttpHeader(string $name, string $value): void
    {
        $this->httpHeaders[$name] = $value;
    }

    /**
     * @param array $httpHeaders
     */
    public function addHttpHeaders(array $httpHeaders): void
    {
        $this->httpHeaders = array_merge($this->httpHeaders, $httpHeaders);
    }

    /**
     * @return array
     */
    public function getHttpHeaders(): array
    {
        $default_headers = $this->getDefaultHttpHeaders();
        return array_merge($default_headers, $this->httpHeaders);
    }

    /**
     * @param string $name
     * @param mixed $default
     *
     * @return mixed
     */
    public function getHttpHeader(string $name, string $default = null): string
    {
        return $this->httpHeaders[$name] ?? $default;
    }

    /**
     * @param string $format
     *
     * @return string|InvalidArgumentException
     */
    public function getResponseBody(string $format = 'json'): string|InvalidArgumentException
    {
        switch ($format) {
            case 'json':
                return $this->parameters ? json_encode($this->parameters) : '';
            case 'xml':
                // this only works for single-level arrays
                $xml = new SimpleXMLElement('<response/>');
                foreach ($this->parameters as $key => $param) {
                    $xml->addChild($key, $param);
                }
                return $xml->asXML();
        }
        throw new InvalidArgumentException(sprintf('The format %s is not supported', $format));
    }


    /**
     * @return Boolean
     *
     * @api
     *
     * @see http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html
     */
    public function isInvalid(): bool
    {
        return $this->statusCode < 100 || $this->statusCode >= 600;
    }

    /**
     * @return Boolean
     *
     * @api
     */
    public function isInformational(): bool
    {
        return $this->statusCode >= 100 && $this->statusCode < 200;
    }

    /**
     * @return Boolean
     *
     * @api
     */
    public function isSuccessful(): bool
    {
        return $this->statusCode >= 200 && $this->statusCode < 300;
    }

    /**
     * @return Boolean
     *
     * @api
     */
    public function isRedirection(): bool
    {
        return $this->statusCode >= 300 && $this->statusCode < 400;
    }

    /**
     * @return Boolean
     *
     * @api
     */
    public function isClientError(): bool
    {
        return $this->statusCode >= 400 && $this->statusCode < 500;
    }

    /**
     * @return Boolean
     *
     * @api
     */
    public function isServerError(): bool
    {
        return $this->statusCode >= 500 && $this->statusCode < 600;
    }
}
