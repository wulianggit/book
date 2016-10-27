<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PdtContent extends Model
{
    /**
     * 关联表名
     * @var string
     */
    protected $table = 'pdt_contents';

    /**
     * 主键
     * @var string
     */
    protected $primaryKey = 'id';
}
