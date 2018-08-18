<?php
/**
 * Created by PhpStorm.
 * User: EASON
 * Date: 2018/7/9
 * Time: 14:31
 */

namespace app\api\controller;
use think\Controller;
use Config;


class oauth extends Controller
{
    protected function _initialize()
    {
        print_r(Config::get('api.'));
    }
}