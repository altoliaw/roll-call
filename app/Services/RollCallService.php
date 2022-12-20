<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * A service for the roll calls
 */
class RollCallService
{
    /**
     * rollCall variable for RollCall instance
     *
     * @var mixed
     */
    protected $rollCall;

    /**
     * Constructor by using the dependency injection mechanism
     *
     * @param  mixed $rollCall
     * @return void
     */
    public function __construct(BaseRepository $rollCall)
    {
        $this->rollCall = $rollCall;
    }

    /**
     * Finding results from the dataset with a specified id
     *
     * @param  int $id
     * @param  mixed $params
     * @return Model|null
     */
    public function find(int $id): Model | null
    {
        return $this->rollCall->find($id);
    }

    /**
     * Searching results from the dataset with specified parameters
     *
     * @param mixed $params
     * @param Closure $closure An extensions in the builder
     * where the extensions are not defined in params
     * @return Collection
     */
    public function search(array $params, Closure $closure = null): Collection | null
    {
        return $this->rollCall->search($params, $closure);
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
        $this->rollCall->update($id, $updatedKvPairs);
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
        return $this->rollCall->create($insertedKvPairs);
    }
}
