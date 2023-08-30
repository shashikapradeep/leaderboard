<?php

namespace App\LeaderBoard\Controller\v1;

use App\Leaderboard\Services\Leader\LeaderService;
use Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class LeaderController extends Controller
{
    protected LeaderService $leaderService;

    /**
     * @param LeaderService $leaderService
     */
    public function __construct(LeaderService $leaderService)
    {
        $this->$leaderService = $leaderService;
    }

    public function search(): JsonResponse
    {
        return response(["hello" => "world"])->json();
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
