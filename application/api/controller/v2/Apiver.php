<?php
/**
 * Created by PhpStorm.
 * User: EASON
 * Date: 2018/7/6
 * Time: 17:03
 */
namespace app\api\controller\v2;

use think\Controller;
use think\Request;

class Apiver extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function read($id)
    {
        // return json(['msg'=>'index_index']);
        return json(['id'=>$id,'msg'=>'v2']);
    }
}