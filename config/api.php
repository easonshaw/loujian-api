<?php
/**
 * Created by PhpStorm.
 * User: EASON
 * Date: 2018/7/9
 * Time: 14:05
 */

// +----------------------------------------------------------------------
// | API设置
// +----------------------------------------------------------------------
return [
    // TOKEN有效期
    'expire'        => 300,
    // 签发者
    'issuer'        => 'https://www.weiaierchang.cn',
    // 密钥
    'secret'        => 'mgMnrBR8XR4E%YftG^oqi06#7IRy#qMc',
    // 运用算法 Supported algorithms are 'HS256', 'HS384', 'HS512' and 'RS256'
    'algorithms'    => 'HS256',
];