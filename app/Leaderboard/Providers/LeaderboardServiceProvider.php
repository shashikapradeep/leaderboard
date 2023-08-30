<?php

namespace Leaderboard\Providers;

class LeaderboardServiceProvider
{
    /**
     * Register any application services.
     * @return void
     */
    public function register()
    {
        $this->registerAllServices();
        $this->registerAllRepositories();
    }

    public function registerAllServices()
    {
        App::bind(LeaderService::class, MetaDataService::class);
    }

    public function registerAllRepositories()
    {
        App::bind(LeaderRepositoryInterface::class, LeaderboardRepository::class);
    }
}
