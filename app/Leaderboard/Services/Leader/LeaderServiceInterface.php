<?php

namespace App\Leaderboard\Services\Leader;

interface LeaderServiceInterface
{

    public function one(int $id);

    public function all($q);

    public function search(string $searchText);

    public function store(array $leaderData);

    public function edit(int $id);

    public function update(array $data, int $id);

    public function delete(int $id);
}
