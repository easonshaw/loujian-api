<?php
/**
 * Created by PhpStorm.
 * User: EASON
 * Date: 2018/7/9
 * Time: 17:33
 */

namespace app\api\controller\v1;
use think\Controller;
use think\Request;
use think\facade\Config;

class User extends Oauth
{
    public function auth()
    {
        //TODO 加入登录验证逻辑, 拿到OPENID/MOBILE可以把ACCESS_TOKEN存入REDIS
        $userinfo = array('id' => 103, 'name' => 'jack');
        $access_token = $this->token($userinfo);
        $redis = new \Redis();
        $redis->connect(Config::get('redis.host'), Config::get('redis.port'));
        $redis->auth(Config::get('redis.auth'));
        $redis->set(Config::get('prefix').'13642896254', $access_token, $this->expire);
        return json(['access_token' => $access_token, 'expire' => $this->expire]);
    }

    public function verification()
    {
        $result = $this->parseToken();
        return json($result, $result['code']);
    }

    public function login()
    {

    }
}