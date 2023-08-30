<?php
namespace Leaderboard\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

use Leaderboard\Services\Leader\LeaderServiceInterface;
use Leaderboard\Services\Leader\LeaderService;

use Leaderboard\Repositories\Leader\LeaderRepositoryInterface;
use Leaderboard\Repositories\Leader\LeaderRepository;

class LeaderboardServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * @return void
     */
    public function register(): void
    {
        $this->registerAllServices();
        $this->registerAllRepositories();
    }

    public function registerAllServices(): void
    {
        App::bind(LeaderServiceInterface::class, LeaderService::class);
    }

    public function registerAllRepositories(): void
    {
        App::bind(LeaderRepositoryInterface::class, LeaderRepository::class);
    }
}
