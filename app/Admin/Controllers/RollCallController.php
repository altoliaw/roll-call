<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\RollCallRepository;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Show;

use App\Admin\Services\RollCallService;

class RollCallController extends AdminController
{
    /* Using the trait */
    use \App\Admin\Traits\Repositories\RollCallGridTrait;

    protected RollCallService $rollCallService;

    /**
     * Constructor with a dependency injection
     * (due to controller mechanism in laravel)
     *
     * @param  mixed $rollCallService
     * @return void
     */
    public function __construct(RollCallService $rollCallService)
    {
        $this->title = trans('page.controllers.rollCall.title');
        $this->rollCallService = $rollCallService;
    }

    /**
     * Generating a list in a grid format
     *
     * @return Grid|null
     */
    protected function grid(): Grid|null
    {
        return $this->rollCallService->getGrid($this->getGridClosure());
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id): Show|string|null
    {
        return $this->rollCallService->getShow($id, $this->getShowClosure());
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form|null
    {
        return $this->rollCallService->getForm($this->getFormClosure());
    }
}
