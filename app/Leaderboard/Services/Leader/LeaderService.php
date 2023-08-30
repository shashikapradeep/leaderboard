<?php

namespace Leaderboard\Services\Leader;

use Leaderboard\Repositories\Leader\LeaderRepository;

class LeaderService
{
    protected LeaderRepository $leaderRepository;

    /**
     * @param LeaderRepository $leaderRepository
     */
    public function __construct(LeaderRepository $leaderRepository)
    {
        $this->leaderRepository = $leaderRepository;
    }
}
