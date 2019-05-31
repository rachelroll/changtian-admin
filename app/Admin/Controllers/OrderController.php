<?php

namespace App\Admin\Controllers;

use App\Order;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class OrderController extends Controller
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
        $grid = new Grid(new Order);
        //禁用创建
        $grid->disableCreateButton();

        $grid->id('Id');
        $grid->amount('订单总金额')->sortable();
        $grid->username('客户名字')->sortable();
        $grid->contact('客户联系方式');
        $grid->address('邮寄地址');

        $grid->comments('备注');
        $grid->column('orderItem', '详情')->display(function ($orderItem) {
            $order = Order::with(['orderItem'=>function($query) {
                $query->select('id as ID','order_id','name as 商品名称','price as 单价','quantity as 重量');
            }])->find($this->id);

            return $order->orderItem->toArray();

        })->table();
        $grid->created_at('创建时间')->sortable();
        $grid->updated_at('更新时间')->sortable();
        //$grid->actions(function ($actions) {
        //    // 当前行的数据数组
        //    $actions->row;
        //    // 获取当前行主键值
        //    $actions->getKey();
        //    $actions->prepend('<a href="">订单详情</a>');
        //});




        $grid->model()->orderBy('id','DESC');

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
        $show = new Show(Order::findOrFail($id));

        $show->id('Id');
        $show->amount('订单总金额');
        $show->username('客户名字');
        $show->contact('客户联系方式');
        $show->address('邮寄地址');
        $show->comments('备注');
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
        $form = new Form(new Order);

        $form->decimal('amount', '订单总金额')->default(0.00);
        $form->text('username', '客户名字');
        $form->text('contact', '客户联系方式');
        $form->text('address', '邮寄地址');
        $form->text('comments', '备注');

        return $form;
    }
}
