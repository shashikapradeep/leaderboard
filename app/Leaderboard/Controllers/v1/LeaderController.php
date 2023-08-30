<?php

namespace Leaderboard\Controller\v1;

use Leaderboard\Controllers\BaseController;
use Leaderboard\Services\Leader\LeaderService;
use Symfony\Component\HttpFoundation\JsonResponse;

class LeaderController extends BaseController
{
    protected LeaderService $leaderService;

    /**
     * @param LeaderService $leaderService
     */
    public function __construct(LeaderService $leaderService)
    {
        $this->leaderService = $leaderService;
    }

    public function search(): JsonResponse
    {
        return $this->response(["hello" => "world"]);
    }

    public function getAll():JsonResponse
    {
        return response()->json();
    }

    public function getOne():JsonResponse
    {
        return response()->json();
    }

    public function update():JsonResponse
    {
        return response()->json();
    }

    public function delete():JsonResponse
    {
        return response()->json();
    }
}
