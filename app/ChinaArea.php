<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChinaArea extends Model
{
    protected $table = 'area';

    public function city()
    {
        return $this->belongsTo(__CLASS__,'parent_id','id');
    }

    public function province()
    {
        return $this->belongsTo(__CLASS__,'parent_id','id');
    }

}
