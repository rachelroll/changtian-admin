<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $appends = [
        'province',
        'city',
        'district',
    ];
    //订单状态
    const STATUS_WAIT_PAY = 0;  //待支付
    const STATUS_PAID = 1;  //已支付
    const STATUS_CONFIRM = 2;  //已发货
    const STATUS_SHIPPED = 3;  //已完成
    const STATUS_RECEIVED = 4;  //已确认收货
    const STATUS_FAILD = 98;  //支付失败
    const STATUS_FINISHED = 99;  //已完成
    const STATUS_CANCEL = -1;  //已取消

    //订单 状态名称
    const STATUS_NAME = [
        self::STATUS_WAIT_PAY => '待支付',
        self::STATUS_PAID     => '已支付',
        self::STATUS_CONFIRM     => '已发货',
        self::STATUS_SHIPPED     => '已完成',
        self::STATUS_RECEIVED     => '已确认收货',
        self::STATUS_FAILD    => '支付失败',
        self::STATUS_FINISHED => '已完成',
        self::STATUS_CANCEL   => '已取消',
    ];

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }


    public function getProvinceAttribute()
    {
        return ChinaArea::where('code', substr($this->provinceId,0,6))->first()->name;
    }
    public function getCityAttribute()
    {
        return ChinaArea::where('code', substr($this->cityId,0,6))->first()->name;
    }
    public function getDistrictAttribute()
    {
        return ChinaArea::where('code', substr($this->districtId,0,6))->first()->name;
    }
}
