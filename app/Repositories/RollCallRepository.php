<?php

namespace App\Repositories;

use App\Models\RollCall;

class RollCallRepository extends BaseRepository
{
    /**
     * Set model name to the BaseRepository class
     *
     * @return string
     */
    protected function getModel(): string
    {
        return RollCall::class;
    }
}
