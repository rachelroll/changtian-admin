<?php

namespace App\Admin\Controllers;

use App\OrderItem;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class OrderItemController extends Controller
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
        $grid = new Grid(new OrderItem);

        $grid->id('Id');
        $grid->order_id('Order id');
        $grid->name('Name');
        $grid->price('Price');
        $grid->quantity('Quantity');
        $grid->column('source_attribute','溯源信息')->display(function($attribute) {
            $str = NULL;
            foreach (explode(PHP_EOL, $attribute) as $val) {
                $str = $str . $val . '<br>';
            }
            return $str;
        });
        $grid->created_at('下单时间');
        $grid->product_at('生产时间');
        $grid->storage_at('入库时间');
        $grid->out_storage_at('出库时间');
        $grid->delivery_at('发货时间');
        $grid->recept_at('收货时间');

        $grid->good_id('Good id');

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
        $show = new Show(OrderItem::findOrFail($id));

        $show->id('Id');
        $show->order_id('Order id');
        $show->name('Name');
        $show->price('Price');
        $show->quantity('Quantity');
        $show->created_at('创建时间');
        $show->updated_at('更新时间');
        $show->good_id('Good id');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new OrderItem);

        $form->display('name', '产品名称');
        $form->display('price', '价格');
        $form->display('quantity', '数量');
        $form->textarea('source_attribute', '溯源信息')->rows(8)->help('这里要注意换行');

        $form->display('created_at','下单时间');
        $form->date('product_at','生产时间');
        $form->date('storage_at','入库时间');
        $form->date('out_storage_at','出库时间');
        $form->date('delivery_at','发货时间');
        $form->date('recept_at','收货时间');


        return $form;
    }
}
