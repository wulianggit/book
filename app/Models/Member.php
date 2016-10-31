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
    protected $fillable = ['nickname', 'mobile', 'email','password', 'active'];

    /**
     * 手机号注册
     * @param array $data
     *
     * @return bool
     * @author wuliang
     */
    public static function registerPhone (array $data)
    {
        $member['active']   = 1; // 手机号注册,默认为激活状态
        $member['mobile']   = $data['phone'];
        $member['password'] = bcrypt($data['password']);
        if (!static::create($member)) {
            return false;
        }

        return true;
    }
    
    public function registerEmail (array $data)
    {
        
    }
}
