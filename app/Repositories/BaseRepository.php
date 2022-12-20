<?php

namespace App\Repositories;

use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

/**
 * An abstract class of the base repository where contain some basic database operations
 */
abstract class BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new ($this->getModel())();
    }

    /**
     * A definition of the main model using in the repository
     */
    abstract protected function getModel(): string;

    /**
     * Finding results from the dataset with a specified id
     *
     * @param  int $id
     * @param  mixed $params
     * @return Model|null
     */
    public function find(int $id): Model|null
    {
        $builder = forward_static_call([$this->getModel(), 'query']);
        return $builder->find($id);
    }

    /**
     * Searching results from the dataset with specified parameters
     *
     * @param mixed $params
     * @param Closure $closure An extensions in the builder
     * where the extensions are not defined in params
     * @return Collection
     */
    public function search(array $params, Closure $closure = null): Collection
    {
        $builder = forward_static_call([$this->getModel(), 'query']);
        $builder = $closure ? $closure($builder) : $builder;
        $queryBuilder = $this->addParams($builder, $params);
        return $queryBuilder->get();
    }

    /**
     * Update data with a key
     *
     * @param  mixed $id
     * @param  mixed $updatedKvPairs An array containing key-values pairs;
     * e.g., ['id'=>10, 'name'=> 'Nick',]
     * @return void
     */
    public function update(int $id, array $updatedKvPairs): void
    {
        $builder = forward_static_call([$this->getModel(), 'query']);
        DB::transaction(function () use ($builder, $id, $updatedKvPairs) {
            $builder->where('id', '=', $id)->update($updatedKvPairs);
        });
    }

    /**
     * Creating a record
     *
     * @param  mixed $insertedKvPairs An array containing key-values pairs;
     * e.g., ['id'=>10, 'name'=> 'Nick',]
     * @return int
     */
    public function create(array $insertedKvPairs): int
    {
        $builder = forward_static_call([$this->getModel(), 'query']);
        DB::transaction(function () use ($builder, $insertedKvPairs) {
            $builder->fill($insertedKvPairs);
            $builder->save();
        });
        return $builder->id;
    }

    /**
     * addParams
     *
     * @param  Builder $builder A Builder creating in this class
     * @param  mixed $params An array,
     * please @see App\Admin\Traits\Serivces\RollCallListTrait::getSearchingParams()
     * @return Builder
     */
    private function addParams(Builder $builder, array $params): Builder
    {
        return $builder->when($params['eager_relations'],
            function ($query, $eager_relations) {
                $query->with($eager_relations);
            })->when($params['where_clauses'],
            function ($query, $where_clauses) {
                $query->where($where_clauses);
            });
    }

    /**
     * Throw exception of using find function
     * @throws Illuminate\Database\Eloquent\ModelNotFoundException
     * @return Model
     */
    public function findOrFail(int $id): Model
    {
        $builder = forward_static_call([$this->getModel(), 'query']);
        return $builder->findOrFail($id);
    }
}
