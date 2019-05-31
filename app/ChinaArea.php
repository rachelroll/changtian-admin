<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChinaArea extends Model
{
    protected $table = 'china_area';

    public function city()
    {
        return $this->belongsTo(__CLASS__::class,'parent_id','id');
    }

    public function province()
    {
        return $this->belongsTo(__CLASS__::class,'parent_id','id');
    }

}
