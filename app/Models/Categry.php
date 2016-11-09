<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categry extends Model
{
    /**
     * 关联表名
     * @var string
     */
    protected $table = 'categories';

    /**
     * 主键
     * @var string
     */
    protected $primaryKey = 'id';
    
    protected $fillable = ['parent_id', 'name', 'sort', 'preview'];
}
