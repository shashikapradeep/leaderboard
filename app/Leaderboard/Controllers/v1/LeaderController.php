<?php

namespace Leaderboard\Controller\v1;

use App\Leaderboard\Requests\Leader\LeaderOneRequest;
use App\Leaderboard\Requests\Leader\LeaderStoreRequest;
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

    public function store(LeaderStoreRequest $leaderStoreRequest): JsonResponse
    {
        return $this->response($this->leaderService->store($leaderStoreRequest->all()));
    }

    public function search(Request $leaderSearchRequest): JsonResponse
    {
        return $this->response($this->leaderService->search($leaderSearchRequest->get('text'), $leaderSearchRequest->get('column'))->toArray());
    }

    public function all(Request $leaderAllRequest):JsonResponse
    {
        return $this->response($this->leaderService->all($leaderAllRequest->get('orderBy') ?? 'id', $leaderAllRequest->get('sortBy') ?? 'desc')->toArray());
    }

    public function one(LeaderOneRequest $leaderOneRequest):JsonResponse
    {
        return $this->response($this->leaderService->store($leaderOneRequest->all()));
//        return $this->response(["hello" => "world"]);
//        return $this->response($getOneRequest->get('id')->toArray());
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
