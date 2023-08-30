<?php
namespace Leaderboard\Repositories\Leader;

use Leaderboard\Repositories\BaseEloquentRepository;

class LeaderRepository extends BaseEloquentRepository implements LeaderRepositoryInterface
{
    private Leader $leader;

    /**
     * NotificationRepository constructor.
     * @param Leader $leader
     */
    public function __construct(Leader $leader)
    {
        $this->model = $leader;
        $this->leader = $leader;
    }

}