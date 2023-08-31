<?php

namespace Leaderboard\Services\Leader;

interface LeaderServiceInterface
{

    public function one(int $id);

    public function all(string $orderBy='', string $sortBy='', array $columns = []);

    public function search(string $searchText, string $column);

    public function store(array $leaderData);

    public function update(array $data, int $id);

    public function delete(int $id);
}
