<?php

namespace App\Http\Controllers;

use App\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{

    public function sourceCode($id)
    {
        $orderItem = OrderItem::find($id);

        return view('order-item.source-code',compact('orderItem'));
    }
}
