<?php
/**
 * Created by PhpStorm.
 * User: EASON
 * Date: 2018/7/6
 * Time: 17:14
 */
Route::resource(':version/wechatgroup','api/:version.Wechatgroup');
Route::rule(':version/user/auth','api/:version.User/auth');
Route::rule(':version/user/verification','api/:version.User/verification');
