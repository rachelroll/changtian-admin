<?php

namespace App\Http\Controllers;

use App\OrderItem;
use Hashids\Hashids;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{

    public function sourceCode($id)
    {
        $orderItem = OrderItem::find($id);
        $hashids = new Hashids('ross',6,'abcdefghijklmnopqrstuvwxyz');
        $url = config('app.front_url') . '/source-code/' . $hashids->encode($orderItem->id);
        dd($url,$orderItem->id,$hashids->decode('grdg'));

        return view('order-item.source-code',compact('orderItem','url'));
    }
}
