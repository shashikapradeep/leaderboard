<?php

namespace Leaderboard\Controller\v1;

use Leaderboard\Requests\Leader\LeaderOneRequest;
use Leaderboard\Requests\Leader\LeaderAllRequest;
use Leaderboard\Requests\Leader\LeaderStoreRequest;
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

    public function one(LeaderOneRequest $leaderOneRequest, int $id):JsonResponse
    {
        return $this->response($this->leaderService->one($id)->toArray());
    }

    public function all(LeaderAllRequest $leaderAllRequest, string $orderBy = 'id', string $sortBy = 'desc'):JsonResponse
    {
        return $this->response($this->leaderService->all($orderBy, $sortBy)->toArray());
    }

    public function search(Request $leaderSearchRequest): JsonResponse
    {
        return $this->response($this->leaderService->search($leaderSearchRequest->get('text'), $leaderSearchRequest->get('column'))->toArray());
    }

    public function store(LeaderStoreRequest $leaderStoreRequest): JsonResponse
    {
        return $this->response($this->leaderService->store($leaderStoreRequest->all()));
    }

    public function update(Request $leaderUpdateRequest, int $id):JsonResponse
    {
        return $this->response($this->leaderService->update($leaderUpdateRequest->all(), $id));
    }

    public function delete():JsonResponse
    {
        return $this->response();
    }
}
