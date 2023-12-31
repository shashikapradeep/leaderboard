<?php

namespace Leaderboard\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

abstract class BaseEloquentRepository
{

    /**
     * Name of model associated with this repository
     * @var Model
     */
    protected Model $model;
    /**
     * Array of method names of relationships available to use
     * @var array
     */
    protected array $relationships = [];
    /**
     * Array of relationships to include in next query
     * @var array
     */
    protected array $requiredRelationships = [];

    /**
     * Get all items
     *
     * @param string|null $columns specific columns to select
     * @param string $orderBy column to sort by
     * @param string $sort sort direction
     * @return Collection
     */
    public function getAll(string $orderBy = 'created_at', string $sort = 'desc', string $columns = '*'): Collection
    {
        return $this->model
            ->with($this->requiredRelationships)
            ->orderBy($orderBy, $sort)
            ->get($columns);
    }

    /**
     * Get paged items
     *
     * @param integer $paged Items per page
     * @param string $orderBy Column to sort by
     * @param string $sort Sort direction
     * @return LengthAwarePaginator
     */
    public function getPaginated(int $paged = 15, string $orderBy = 'created_at', string $sort = 'desc'): LengthAwarePaginator
    {
        return $this->model
            ->with($this->requiredRelationships)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * Get item by its id
     *
     * @param integer $id
     * @return Model|null
     */
    public function getById(int $id): Model|null
    {
        return $this->model
            ->with($this->requiredRelationships)
            ->find($id);
    }

    /**
     * Get instance of model by column
     *
     * @param mixed $term search term
     * @param string $column column to search
     * @return Model|null
     */
    public function getItemByColumn(string $term, string $column = 'slug'): Model|null
    {
        return $this->model
            ->with($this->requiredRelationships)
            ->where($column, '=', $term)
            ->first();
    }

    /**
     * Get instance of model by column
     *
     * @param mixed $term search term
     * @param string $column column to search
     * @return Collection
     */
    public function getCollectionByColumn(string $term, string $column = 'slug'): Collection
    {
        return $this->model
            ->with($this->requiredRelationships)
            ->where($column, 'Like', '%' . $term . '%')
            ->get();
    }


    /**
     * Create new using mass assignment
     *
     * @return mixed
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * Update a record using the primary key.
     *
     * @param array $data
     * @param int $id primary key
     * @return
     */
    public function update(array $data, int $id)
    {
        return $this->model->where($this->model->getKeyName(), $id)->update($data);
    }

    /**
     * Update or crate a record and return the entity
     *
     * @param array $identifiers columns to search for
     * @param array $data
     * @return mixed
     */
    public function updateOrCreate(array $identifiers, array $data): mixed
    {
        return $this->model::updateOrCreate($identifiers, $data);
    }

    /**
     * Delete a record by the primary key.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->model->where($this->model->getKeyName(), $id)->delete();
    }

}
