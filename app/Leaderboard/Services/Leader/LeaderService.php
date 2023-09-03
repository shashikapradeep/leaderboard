<?php

namespace Leaderboard\Services\Leader;

use Leaderboard\Repositories\Leader\LeaderRepository;
use \Illuminate\Database\Eloquent\Collection;
use \Illuminate\Database\Eloquent\Model;

class LeaderService implements LeaderServiceInterface
{
    protected LeaderRepository $leaderRepository;

    /**
     * @param LeaderRepository $leaderRepository
     */
    public function __construct(LeaderRepository $leaderRepository)
    {
        $this->leaderRepository = $leaderRepository;
    }

    public function store(array $leaderData): Model
    {
        return $this->leaderRepository->create($leaderData);
    }

    public function one(int $id): Model
    {
        return $this->leaderRepository->getById($id);
    }

    public function all(string $orderBy = 'id', string $sortBy = 'asc', array $columns = []): Collection
    {
        return $this->leaderRepository->getAll($orderBy, $sortBy);
    }

    public function update(array $data, int $id)
    {
        return $this->leaderRepository->update($data, $id);
    }

    public function delete($id): bool
    {
        return $this->leaderRepository->delete($id);
    }

    public function search(string $searchText, string $column): Collection
    {
        return $this->leaderRepository->getCollectionByColumn($searchText, $column);
    }
}
