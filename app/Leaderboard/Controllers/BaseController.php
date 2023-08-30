<?php
namespace Leaderboard\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Leaderboard\Traits\HttpResponse;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, HttpResponse;

    /**
     * @param array|null $data
     * @param string $message
     * @param int $statusCode
     * @param array $headers
     * @return JsonResponse
     */
    public function response(array $data = null, string $message = '', int $statusCode = 200, array $headers = []): JsonResponse
    {
        return $this->sendResponse($data, $message, $statusCode, $headers);
    }

    /**
     * to send an error response by the controller
     * @param null $data
     * @param string $message
     * @param int $statusCode
     * @param array $headers
     * @return JsonResponse
     */
    public function error($data = null, string $message = 'Something went wrong. Please try again.', int $statusCode = 422, array $headers = []): JsonResponse
    {
        return $this->sendErrorResponse($data, $message, $statusCode, $headers);
    }
}
