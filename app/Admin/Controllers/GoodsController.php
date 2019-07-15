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

        $grid->filter(function ($filter) {
            //展开过滤
            $filter->expand();
            // 去掉默认的id过滤器

            // 在这里添加字段过滤器
            $filter->like('name', '商品名称');
            $filter->like('kind', '品种');
        });


        $grid->id('Id');
        $grid->name('商品名称')->editable();
        $grid->kind('品种')->editable();
        $grid->size('规格')->editable();
        $grid->shipping_date('发货期限')->editable();
        $grid->shipping_place('发货地');
        $grid->price('单价')->editable();
        //$grid->pictures('商品图片');
        $grid->pictures('商品图片')->lightbox(['width' => 100]);
        $grid->column('category.name' ,'分类');
        $grid->created_at('创建时间');
        $grid->updated_at('更新时间');



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
        $show->created_at('创建时间');
        $show->updated_at('更新时间');

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
        $form->textarea('intro', '商品简介');
        $form->text('kind', '品种');
        $form->text('size', '规格');
        $form->text('shipping_date', '发货期限')->default('订单提交后2日内发货');
        $form->text('shipping_place', '发货地');
        $form->file('video.fdMp4','视频');
        $form->currency('price','单价')->symbol('￥');
        $form->multipleImage('pictures', '商品图片')->help('可以一次性选择多张');

        return $form;
    }
}
