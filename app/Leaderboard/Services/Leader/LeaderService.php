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

    /**
     * @param array $leaderData
     * @return Model
     */
    public function store(array $leaderData): Model
    {
        return $this->leaderRepository->create($leaderData);
    }

    /**
     * @param int $id
     * @return Model
     */
    public function one(int $id): Model | null
    {
        return $this->leaderRepository->getById($id);
    }

    /**
     * @param string $orderBy
     * @param string $sortBy
     * @param array $columns
     * @return Collection
     */
    public function all(string $orderBy = 'id', string $sortBy = 'asc', array $columns = []): Collection
    {
        return $this->leaderRepository->getAll($orderBy, $sortBy);
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update(array $data, int $id)
    {
        return $this->leaderRepository->update($data, $id);
    }

    public function updateScore(int $id, string $context): array
    {
        $leader = $this->leaderRepository->getById($id);
        switch($context){
            case INCREASE_LEADER_SCORE:
                $leader->points = ++$leader->points;
                break;
            case DECREASE_LEADER_SCORE:
                $leader->points = --$leader->points;
                break;
            case RESET_LEADER_SCORE:
                $leader->points = 0;
                break;
        }
        $leader->save();
        return $leader->toArray();
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        return $this->leaderRepository->delete($id);
    }

    /**
     * @param string $searchText
     * @param string $column
     * @return Collection
     */
    public function search(string $searchText, string $column): Collection
    {
        return $this->leaderRepository->getCollectionByColumn($searchText, $column);
    }
}
