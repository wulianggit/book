<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    /**
     * 关联表名
     * @var string
     */
    protected $table = 'cart_items';

    /**
     * 主键
     * @var string
     */
    protected $primaryKey = 'id';

    protected $fillable = ['member_id', 'product_id', 'count'];
}
