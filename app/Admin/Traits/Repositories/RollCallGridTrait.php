<?php
namespace App\Admin\Traits\Repositories;

use Closure;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Form;

trait RollCallGridTrait {

    /**
     * Assign a grid setting closure
     *
     * @return Closure
     */
    public function getGridClosure(): Closure
    {
        return function (Grid $grid)
        {
            /* Grid data binding */
            $grid->model()->with(['courseUser.user', 'courseUser.course'])
                ->orderBy('id', 'desc');

            /* Columns definitions */
            $grid->column('id', $this->getTrans()['id'])->sortable();
            $grid->column('iscalled', $this->getTrans()['isCalled'])->bool()
                ->help($this->getTrans()['signComment']);
            $grid->column('courseUser.user.account', $this->getTrans()['account']);
            $grid->column('courseUser.user.name', $this->getTrans()['user.name']);
            $grid->column('courseUser.course.name', $this->getTrans()['course.name']);
            $grid->column('created_at', $this->getTrans()['createdAt'])->sortable();
            $grid->column('updated_at', $this->getTrans()['updatedAt'])->sortable();


            /* Tools definition*/
            $grid->showColumnSelector();

            /* Filter definition */
            $grid->filter(function (Grid\Filter $filter) {
                $filter->like('courseUser.user.account', $this->getTrans()['account']);
                $filter->like('courseUser.user.name', $this->getTrans()['user.name']);
                $filter->like('courseUser.course.name', $this->getTrans()['course.name']);
            });
        };
    }

    /**
     * Assign a show setting closure
     *
     * @return Closure
     */
    public function getShowClosure(): Closure
    {
        return function (Show $show)
        {
            $show->field('id', $this->getTrans()['id'])->width(3);
            $show->field('url', $this->getTrans()['url'])->width(3);
            $show->field('iscalled', $this->getTrans()['isCalled'])
                ->bool()->width(3);
            /* According to the guide in detail show page, all relations using the camel case
             * in Model shall be revised in the snake case format (e.g., 如果你的关联模型名称的命名是驼峰风格，
             * 那么使用的时候需要转化为下划线风格命名)
             */
            $show->field('course_user.user.account', $this->getTrans()['account'])->width(3);
            $show->field('course_user.user.name', $this->getTrans()['user.name'])->width(3);
            $show->field('course_user.course.name', $this->getTrans()['course.name'])->width(3);
            $show->field('created_at', $this->getTrans()['createdAt'])->width(3);
            $show->field('updated_at', $this->getTrans()['updatedAt'])->width(3);
            $show->field('verified_at', $this->getTrans()['verifiedAt'])->width(3);
        };
    }

    public function getFormClosure(): Closure
    {
        return function (Form $form) {
            $form->display('id', $this->getTrans()['id'])->width(3);
            $form->text('url', $this->getTrans()['url'])->width(3);
            $form->switch('iscalled', $this->getTrans()['isCalled']);
            $form->display('course_user.user.account', $this->getTrans()['account'])->width(3);
            $form->display('course_user.user.name', $this->getTrans()['user.name'])->width(3);
            $form->display('course_user.course.name', $this->getTrans()['course.name'])->width(3);
            $form->display('created_at', $this->getTrans()['createdAt'])->width(3);
            $form->display('updated_at', $this->getTrans()['updatedAt'])->width(3);
            $form->datetime('verified_at', $this->getTrans()['verifiedAt'])->width(3);
        };
    }

    /**
     * For reducing the length when using lang, here an array is used
     *
     * @return array
     */
    private function getTrans(): array
    {
        return [
            'id' => trans('page.controllers.common.id'),
            'url' => trans('page.controllers.rollCall.url'),
            'isCalled' => trans('page.controllers.rollCall.isCalled'),
            'usingIsCalledClose' => trans('page.controllers.rollCall.usingIsCalledClose'),
            'usingIsCalledOpen' => trans('page.controllers.rollCall.usingIsCalledOpen'),
            'account' => trans('page.controllers.user.account'),
            'user.name' => trans('page.controllers.user.name'),
            'course.name' => trans('page.controllers.course.name'),
            'createdAt' => trans('page.controllers.common.createdAt'),
            'updatedAt' => trans('page.controllers.common.updatedAt'),
            'verifiedAt' => trans('page.controllers.common.verifiedAt'),
            'signComment' => trans('page.controllers.rollCall.signComment'),
        ];
    }
}