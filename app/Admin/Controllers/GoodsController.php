<?php

namespace App\Admin\Controllers;

use App\Good;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class GoodsController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Good);

        $grid->id('Id');
        $grid->name('Name');
        $grid->intro('Intro');
        $grid->kind('Kind');
        $grid->shipping_date('Shipping date');
        $grid->shipping_place('Shipping place');
        $grid->price('Price');
        $grid->pictures('Pictures');
        //$grid->picture()->lightbox();
        $grid->category_id('Category id');
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Good::findOrFail($id));

        $show->id('Id');
        $show->name('Name');
        $show->intro('Intro');
        $show->kind('Kind');
        $show->shipping_date('Shipping date');
        $show->shipping_place('Shipping place');
        $show->price('Price');
        $show->pictures('Pictures');
        $show->category_id('Category id');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Good);

        $form->text('name', 'Name');
        $form->text('intro', 'Intro');
        $form->text('kind', 'Kind');
        $form->text('shipping_date', 'Shipping date');
        $form->text('shipping_place', 'Shipping place');
        $form->decimal('price', 'Price')->default(0.00);
        $form->text('pictures', 'Pictures');
        $form->text('category_id', 'Category id');

        return $form;
    }
}
