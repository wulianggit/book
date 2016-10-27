<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * 关联表名
     * @var string
     */
    protected $table = 'products';

    /**
     * 主键
     * @var string
     */
    protected $primaryKey = 'id';
}
