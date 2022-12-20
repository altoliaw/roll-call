<?php

namespace App\Admin\Repositories;

use Carbon\Carbon;
use Dcat\Admin\Repositories\EloquentRepository;
use App\Models\RollCall;
use Dcat\Admin\Form;


class RollCallRepository extends EloquentRepository
{
    protected $eloquentClass = RollCall::class;

    /**
     * Deleting data, extends from EloquentRepository
     *
     * @param  Form  $form
     * @param  array  $originalData
     * @return bool
     */
    public function delete(Form $form, array $originalData)
    {
        $models = $this->collection->keyBy($this->getKeyName());

        collect(explode(',', $form->getKey()))->filter()->each(function ($id) use ($form, $models) {

            $model = $models->get($id);
            if (! $model) {
                return;
            }

            $model->update(['verified_at'=> Carbon::now()]);
        });

        return true;
    }
}