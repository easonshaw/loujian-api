<?php
/**
 * Created by PhpStorm.
 * User: EASON
 * Date: 2018/7/6
 * Time: 17:03
 */
namespace app\api\controller\v1;

use think\Controller;
use think\Request;
use think\facade\Config;


class Apiver extends Oauth
{
    protected $request;

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function read($id)
    {
        // echo ' v1->apiver  '.$id;
        // return json(['msg'=>'index_index']);
        return json(['id'=>$id,'msg'=>'apver v1']);
    }

    public function auth()
    {
        //TODO 加入登录验证逻辑
        $userinfo = array('id' => 102, 'name' => 'eason');
        return json(['access_token' => $this->token($userinfo), 'expire' => $this->expire]);
    }

    public function verification()
    {
        return json($this->parseToken());
    }
}