<?php

namespace App\Admin\Controllers;

use App\Order;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;

class OrderController extends Controller
{

    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     *
     * @return Content
     */
    public function index(Content $content)
    {
        return $content->header('Index')->description('description')->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed   $id
     * @param Content $content
     *
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content->header('Detail')->description('description')->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed   $id
     * @param Content $content
     *
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content->header('Edit')->description('description')->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     *
     * @return Content
     */
    public function create(Content $content)
    {
        return $content->header('Create')->description('description')->body($this->form());
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
        $grid->filter(function ($filter) {

            // 去掉默认的id过滤器
            //$filter->disableIdFilter();
            $filter->expand();

            // 在这里添加字段过滤器
            $filter->like('username', '客户名字');
            $filter->like('contact', '客户联系方式');

        });
        $this->getColumn($grid);
        $grid->actions(function ($actions) {


            // prepend一个操作
            $row = $actions->row;
            switch ($row['status']) {
                case Order::STATUS_PAID:
                    $status = Order::STATUS_CONFIRM;
                    $btn_name = '发货';
                    break;
                case Order::STATUS_CONFIRM:
                    $status = Order::STATUS_SHIPPED;
                    $btn_name = '完成';
                    break;
                //case Order::STATUS_SHIPPED:
                //    $status = Order::STATUS_RECEIVED;
                //    $btn_name = '确认收货';
                //    break;
                //case Order::STATUS_RECEIVED:
                //    $status = Order::STATUS_FINISHED;
                //    $btn_name = '完成订单';
                //    break;
                default:
                    $status = $row['status'];
                    $btn_name = '';
                        break;
            }
            if ($btn_name) {
                $actions->append('<a onclick="return confirm(\'确定操作?\')" class="btn btn-xs btn-info" style="margin:4px;" href="' . route('admin.order.update-status',
                        ['id' => $actions->getKey(),'status'=>$status]) . '">' . $btn_name . '</a>');
            }

            $actions->append('<a  target="_blank"  class="btn btn-xs btn-info" style="margin:4px;" href="' . route('admin.order.print',
                    ['id' => $actions->getKey()]) . '">订单打印</a>');

            // prepend一个操作
            $actions->append('<a class="btn btn-xs btn-success" style="margin:4px;" href="' . route('order-items.index',
                    ['order_id' => $actions->getKey()]) . '">订单详情</a>');
            $actions->append('<a onclick="return confirm(\'确定取消订单?\')" style="margin:4px;" class="btn btn-xs btn-danger" href="' . route('admin.order.update-status',
                    ['id' => $actions->getKey(),'status'=>Order::STATUS_CANCEL]) . '">取消订单</a>');

        });

        $grid->model()->orderBy('id', 'DESC');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
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

        $form->display('order_sn', '订单编号');
        $form->decimal('amount', '订单总金额')->default(0.00);
        $form->text('username', '客户名字');

        $form->text('contact', '客户联系方式');
        $form->text('address', '邮寄地址');
        $form->text('comments', '备注');
        $form->text('express_number', '物流编号');
        $form->text('express_name', '物流公司');

        return $form;
    }

    /**
     * @param Grid $grid
     */
    protected function getColumn(Grid $grid)
    : void {
        $grid->id('Id')->sortable();
        $grid->order_sn('订单编号')->sortable();
        $grid->amount('订单总金额')->sortable();
        $grid->username('客户名字')->sortable();
        $grid->contact('客户联系方式');
        $grid->address('邮寄地址');


        $grid->comments('备注');
        //$grid->column('orderItem', '详情')->display(function ($orderItem) {
        //    $order = Order::with([
        //        'orderItem' => function ($query) {
        //            $query->select('id as ID', 'order_id as order_id', 'name as 商品名称', 'price as 单价', 'quantity as 重量');
        //        },
        //    ])->find($this->id);
        //
        //    return $order->orderItem->toArray();
        //
        //})->table();
        $grid->status('订单状态')->using(Order::STATUS_NAME)->sortable();
        $grid->created_at('创建时间')->sortable();
        $grid->updated_at('更新时间')->sortable();
        $grid->express_number('物流编号')->editable();
        $grid->express_name('物流公司')->editable();
    }

    public function updateStatus($id)
    {
        $status = request('status');
        $order = Order::where('id',$id)->update([
            'status'=>$status
        ]);
        admin_toastr('提交成功', 'success');
        return back();
    }

    public function print()
    {
        $order = Order::with('orderItem')->find(request()->get('id'));
        return view('order.print',compact('order'));
    }
}
