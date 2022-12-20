<?php

namespace App\Admin\Services;

use Closure;
use App\Admin\Repositories\RollCallRepository;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Form;

class RollCallService {

    public function getGrid(Closure $closure): Grid|null
    {
        return Grid::make(new RollCallRepository(), $closure);
    }

    public function getShow(int $id, Closure $closure): Show|null
    {
        return Show::make($id, RollCallRepository::with(['courseUser.user', 'courseUser.course']), $closure);
    }

    public function getForm(Closure $closure): Form|null
    {
        return Form::make(RollCallRepository::with(['courseUser.user', 'courseUser.course']), $closure);
    }

}