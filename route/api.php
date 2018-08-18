<?php
/**
 * Created by PhpStorm.
 * User: EASON
 * Date: 2018/7/6
 * Time: 17:14
 */

Route::group(':version', function () {
    Route::resource('wechatgroup','api/:version.Wechatgroup');
    Route::rule('user/auth','api/:version.User/auth')->allowCrossDomain();
    Route::get('user/login','api/:version.User/login')->allowCrossDomain();
});
