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

    /**
     * @var array
     */
    protected $fillable = ['nickname', 'mobile', 'password'];

    /**
     * 手机号注册
     * @param array $attribute
     *
     * @return bool
     * @author wuliang
     */
    public static function registerPhone (array $attribute)
    {
        if (!static::create($attribute)) {
            return false;
        }

        return true;
    }
}
