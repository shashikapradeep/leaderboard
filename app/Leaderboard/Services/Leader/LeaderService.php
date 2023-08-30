<?php


namespace App\Leaderboard\Services\Leader;


use App\Leaderboard\Repositories\Leader\LeaderRepository;

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
