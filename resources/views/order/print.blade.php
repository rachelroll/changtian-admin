<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://jkwedu-new.oss-cn-beijing.aliyuncs.com/public-cdn/bootstrap/4.3/bootstrap.min.css"
          rel="stylesheet">

    <title>订单打印</title>
</head>
<body>
<br>
<br>
<br>
<div class="container">
    <h4>基本信息</h4>
    <hr>
    <div class="row">
        <div class="col">订单编号: {{ $order->order_sn }}</div>
        <div class="col">订单总金额: ¥{{ $order->amount }} </div>
        <div class="col">订单状态: {{ \Illuminate\Support\Arr::get(\App\Order::STATUS_NAME,$order->status) }}</div>
    </div>
    <br>
    <div class="row">
        <div class="col-4">下单时间: {{ $order->created_at }}</div>
        <div class="col-8">备注: {{ $order->remark }}</div>
    </div>

</div>
<br>
<div class="container">
    <br>
    <h4>订单详情</h4>
    <hr>
    @foreach($order->orderItem as $orderItem)
        <div class="row">
            <div class="col">商品名称: {{ $orderItem->name }}</div>
            <div class="col">商品单价: {{ $orderItem->price }}</div>
            <div class="col">商品数量: {{ $orderItem->quantity }}</div>
        </div>
    @endforeach
</div>
<br>
<br>
<br>
<div class="container">
    <h4>收货人信息</h4>
    <hr>
    <div class="row">
        <div class="col">收货人:{{ $order->user_name }}</div>
        <div class="col">收货地址: {{ $order->address }} </div>
        <div class="col">电话: {{ $order->contact }}</div>
    </div>
</div>
<script src="https://jkwedu-new.oss-cn-beijing.aliyuncs.com/public-cdn/bootstrap/4.3/bootstrap.min.js"></script>
</body>
</html>
