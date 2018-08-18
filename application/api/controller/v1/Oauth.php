<?php
/**
 * Created by PhpStorm.
 * User: EASON
 * Date: 2018/7/9
 * Time: 14:31
 */

namespace app\api\controller\v1;
use think\Controller;
use think\Request;
use think\Response;
use Config;

use \Firebase\JWT\JWT;

class Oauth extends Controller
{
    protected $secret;
    protected $algorithms;
    public  $expire;
    protected $issuer;

    protected function initialize()
    {
        $this->secret = Config::get('api.secret');
        $this->algorithms = Config::get('api.algorithms');
        $this->expire = Config::get('api.expire');
        $this->issuer = Config::get('api.issuer');
    }

    /**
     * 获取TOKEN
     * @return string
     */
    public function token(array $data = array(), $keyId = null, $head = null)
    {
        $time = time(); // 当前时间
        $token = [
            'iss' => $this->issuer, // 签发者 可选
            'iat' => $time, // 签发时间
            'nbf' => $time+30 , // (Not Before)：某个时间点后才能访问，比如设置time+30，表示当前时间30秒后才能使用
            'exp' => $time+$this->expire, // 过期时间
            'data' => [
                $data
            ]
        ];
        return JWT::encode($token, $this->secret, $this->algorithms, $keyId, $head); //输出Token
    }

    /**
     * 获取authorization
     * @return string
     */
    public function getBearerToken()
    {
        $headers = $this->request->header('authorization');
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }

    /**
     * 解析TOKEN
     * @return array
     */
    public function parseToken()
    {
        try {
            $jwt = $this->getBearerToken();
            JWT::$leeway = 60; // 当前时间减去60，把时间留点余地
            $decoded = JWT::decode($jwt, $this->secret, [$this->algorithms]); // HS256方式，这里要和签发的时候对应
            $arr = (array)$decoded;
            return array('message' => 'success!', 'data' => isset($arr['data']) ? $arr['data'] : array(), 'code' => 200);
        } catch (\DomainException $e) {
            return array('message' => $e->getMessage(), 'code' => 401);
        } catch (\InvalidArgumentException $e) {
            return array('message' => $e->getMessage(), 'code' => 401);
        } catch (\UnexpectedValueException $e) {
            return array('message' => $e->getMessage(), 'code' => 401);
        } catch(\Firebase\JWT\SignatureInvalidException $e) {
            return array('message' => $e->getMessage(), 'code' => 401); // 签名不正确
        } catch(\Firebase\JWT\BeforeValidException $e) {
            return array('message' => $e->getMessage(), 'code' => 401); // 签名在某个时间点之后才能用
        } catch(\Firebase\JWT\ExpiredException $e) {
            return array('message' => $e->getMessage(), 'code' => 401); // token过期
        }catch(\Exception $e) {
            return array('message' => $e->getMessage(), 'code' => 401); // 其他错误
        }
        // Firebase定义了多个 throw new，我们可以捕获多个catch来定义问题，catch加入自己的业务，比如token过期可以用当前Token刷新一个新Token
    }
}