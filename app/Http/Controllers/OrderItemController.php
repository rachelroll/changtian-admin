<?php

namespace App\Http\Controllers;

use App\OrderItem;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class OrderItemController extends Controller
{

    public function sourceCode($id)
    {
        $orderItem = OrderItem::find($id);
        $hashids = new Hashids('ross',10,'123456789ABCDEFGH');
        $url = config('app.front_url') . '/source-code/' . $hashids->encode($orderItem->id);
        $orderItem->source_attribute = explode("\r\n", $orderItem->source_attribute);

        return view('order-item.source-code',compact('orderItem','url'));
    }
}
