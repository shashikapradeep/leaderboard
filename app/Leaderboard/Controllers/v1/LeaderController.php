<?php

namespace Leaderboard\Controller\v1;

use Leaderboard\Requests\Leader\LeaderDeleteRequest;
use Leaderboard\Requests\Leader\LeaderOneRequest;
use Leaderboard\Requests\Leader\LeaderAllRequest;
use Leaderboard\Requests\Leader\LeaderStoreRequest;
use Illuminate\Http\Request;
use Leaderboard\Controllers\BaseController;
use Leaderboard\Requests\Leader\LeaderUpdateRequest;
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

    /**
     * @param LeaderOneRequest $leaderOneRequest
     * @param int $id
     * @return JsonResponse
     */
    public function one(LeaderOneRequest $leaderOneRequest, int $id): JsonResponse
    {
        return $this->response($this->leaderService->one($id)->toArray());
    }

    /**
     * @param LeaderAllRequest $leaderAllRequest
     * @param string $orderBy
     * @param string $sortBy
     * @return JsonResponse
     */
    public function all(LeaderAllRequest $leaderAllRequest, string $orderBy = 'id', string $sortBy = 'desc'): JsonResponse
    {
        return $this->response($this->leaderService->all($orderBy, $sortBy)->toArray());
    }

    /**
     * @param Request $leaderSearchRequest
     * @return JsonResponse
     */
    public function search(Request $leaderSearchRequest, string $text, string $column = null): JsonResponse
    {
        return $this->response($this->leaderService->search($text, $column)->toArray());
    }

    /**
     * @param LeaderStoreRequest $leaderStoreRequest
     * @return JsonResponse
     */
    public function store(LeaderStoreRequest $leaderStoreRequest): JsonResponse
    {
        return $this->response($this->leaderService->store($leaderStoreRequest->all())->toArray());
    }

    /**
     * @param LeaderUpdateRequest $leaderUpdateRequest
     * @param int $id
     * @return JsonResponse
     */
    public function update(LeaderUpdateRequest $leaderUpdateRequest, int $id): JsonResponse
    {
        $this->leaderService->update($leaderUpdateRequest->all(), $id);
        return $this->response($this->leaderService->one($id)->toArray());
    }

    /**
     * @param LeaderDeleteRequest $leaderDeleteRequest
     * @param $id
     * @return JsonResponse
     */
    public function delete(LeaderDeleteRequest $leaderDeleteRequest, $id): JsonResponse
    {
        return $this->response(["status" => $this->leaderService->delete($id)]);
    }
}
