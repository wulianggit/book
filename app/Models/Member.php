<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /**
     * 关联表名
     * @var string
     */
    protected $table = 'members';

    /**
     * 主键
     * @var string
     */
    protected $primaryKey = 'id';
}
