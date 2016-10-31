<?php

namespace App\Models;

use App\Events\MemberRegistered;
use App\Tools\UUID;
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
    protected $fillable = [
        'nickname', 'mobile', 'email',
        'token', 'password', 'active',
        'deadline'
    ];

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

    /**
     * 邮箱注册用户
     * @param array $data
     *
     * @return bool
     * @author wuliang
     */
    public static function registerEmail (array $data)
    {
        $member['email']    = $data['email'];
        $member['token']    = UUID::create();
        $member['deadline'] = date('Y-m-d H:i:s', time() + 60*60*24);
        $member['password'] = bcrypt($data['password']);
        $member = static::create($member);
        if ($member) {
            // 执行发送邮件事件
            event(new MemberRegistered($member));
            return true;
        }

        return false;
    }

}
