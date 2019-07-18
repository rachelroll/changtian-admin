<?php

namespace App\Admin\Controllers;

use App\Banner;
use App\Good;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BannerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Banner';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $goods = Good::where('enabled', 1)->pluck('name','id')->toArray();
        $goods_options =   [0=>'请选择'] + $goods;
        $grid = new Grid(new Banner);

        $grid->column('id', __('ID'));
        $states = [
            'on'  => ['value' => 1, 'text' => '启用', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => '禁用', 'color' => 'danger'],
        ];
        $grid->column('enabled','启用禁用')->switch($states);
        $grid->picUrl('图片')->lightbox(['width' => 100]);
        $grid->column('goods_id','选择跳转商品')->select($goods_options);

        $grid->column('created_at', __('创建时间'));
        $grid->column('updated_at', __('更新时间'));

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
        $show = new Show(Banner::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('picUrl', __('PicUrl'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $goods = Good::where('enabled', 1)->pluck('name','id')->toArray();
        $goods_options =   [0=>'请选择'] + $goods;
        $form = new Form(new Banner);

        $options = [
            'on'  => ['value' => 1, 'text' => '启用', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => '禁用', 'color' => 'danger'],
        ];
        $form->select('goods_id','跳转商品')->options($goods_options);
        $form->switch('enabled', '启用禁用')->states($options);
        $form->image('picUrl','图片');

        return $form;
    }
}
