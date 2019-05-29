<?php

namespace App;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Encore\Admin\Tree;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use AdminBuilder, ModelTree {
        ModelTree::boot as treeBoot;
    }
    /**
     * @param \Closure $callback
     *
     * @return Tree
     */
    public static function tree(\Closure $callback = null)
    {
        return new Tree(new static(), $callback);
    }
}
