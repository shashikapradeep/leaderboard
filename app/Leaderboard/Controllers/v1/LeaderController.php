<?php

namespace Leaderboard\Controller\v1;

use Illuminate\Http\Request;
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

    public function store(Request $leaderData): JsonResponse
    {
        return $this->response($this->leaderService->store($leaderData->all())->toArray());
    }

    public function search(Request $searchRequest): JsonResponse
    {
        return $this->response($this->leaderService->search($searchRequest->get('text'), $searchRequest->get('column'))->toArray());
    }

    public function all(Request $getAllRequest):JsonResponse
    {
        return $this->response($this->leaderService->all($getAllRequest->get('orderBy'), $getAllRequest->get('sortBy'))->toArray());
    }

    public function one(Request $getOneRequest):JsonResponse
    {
        return $this->response(["hello" => "world"]);
//        return $this->response($getOneRequest->get('id')->toArray());
    }

    public function update(Request $updateRequest, int $id):JsonResponse
    {
        return $this->response($this->leaderService->update($updateRequest->all(), $id));
    }

    public function delete():JsonResponse
    {
        return $this->response();
    }
}
