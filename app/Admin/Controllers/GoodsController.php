<?php

namespace App\Admin\Controllers;

use App\Category;
use App\ChinaArea;
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

    private $header = '产品模块';

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header($this->header . '-' . 'Index')
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
            ->header($this->header . '-' . 'Detail')
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
            ->header($this->header . '-' . 'Edit')
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
            ->header($this->header . '-' . 'Create')
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
        $grid->name('商品名称');
        $grid->kind('品种');
        $grid->shipping_date('发货期限');
        $grid->shipping_place('发货地');
        $grid->price('单价');
        //$grid->pictures('商品图片');
        $grid->pictures('商品图片')->lightbox(['width' => 100]);
        $grid->column('category.name');
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
        $show->name('商品名称');
        $show->intro('商品简介');
        $show->kind('品种');
        $show->shipping_date('发货期限');
        $show->shipping_place('发货地');
        $show->price('单价');
        $show->pictures('商品图片');
        $show->category_id('分类 ID');
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

        $form->text('name', '商品名称');
        $form->select('category_id', '分类')->options(Category::orderBy('order','ASC')->pluck('name','id'));
        $form->simditor('intro', '商品简介');
        $form->text('kind', '品种');
        $form->text('shipping_date', '发货期限')->default('订单提交后2日内发货');
        $form->distpicker(['province_id', 'city_id', 'district_id'],'发货地')->autoselect(3)->default([
            'province' => 130000,
            'city'     => 130200,
            'district' => 130203,
        ]);
        $form->currency('price','单价')->symbol('￥');
        $form->multipleImage('pictures', '商品图片')->help('可以一次性选择多张');
        $form->saving(function (Form $form) {
            $area = ChinaArea::with('city','province')->where('code', $form->district)->first();
            $form->model()->shipping_place = $area->province->name . '-' . $area->city->name . '-' .$area->name;

        });

        return $form;
    }
}
