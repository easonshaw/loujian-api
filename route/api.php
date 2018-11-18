<?php
/**
 * Created by PhpStorm.
 * User: EASON
 * Date: 2018/7/6
 * Time: 17:14
 */

Route::group(':version', function () {
    Route::get('user/auth','api/:version.User/auth')->allowCrossDomain();
    Route::post('user/login','api/:version.User/login')->allowCrossDomain();
});
