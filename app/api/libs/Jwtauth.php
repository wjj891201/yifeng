<?php


namespace app\api\libs;

use app\api\model\User;
use app\exception\HttpExceptions;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;
use think\facade\Request;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Hmac\Sha256;

/**
 * 1.生成令牌
 * 2.设置登录状态
 * 3.验证登录状态
 * Class Auth
 * @package app\api\libs
 */
class Jwtauth
{
    private $token = '';
    private $username = '';
    private static $instance = null;

    private function __construct()
    {
        $request = Request::instance();
        $this->username = $request->post('username');
        $this->token = $request->param('token');
        if ($this->token !== '' && $this->token != null) {
            $this->token = (new Parser())->parse($this->token);
            $this->username = $this->token->getClaim('username');
        }
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    //统一的入口
    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    //获取token
    public function getToken()
    {
        return $this->token;
    }

    public function setToken()
    {
        $this->createToken();
        return $this;
    }

    //获取username
    public function getUsername()
    {
        return $this->username;
    }

    //生成token

    private function createToken()
    {
        $time = time();
        $signer = new Sha256();
        $this->token = (new Builder())->issuedBy('http://api.yifeng.deve') // Configures the issuer (iss claim)
        ->identifiedBy('apiyifengcom', true) // Configures the id (jti claim), replicating as a header item
        ->issuedAt($time) // Configures the time that the token was issue (iat claim)
        ->canOnlyBeUsedAfter($time + 60) // Configures the time that the token can be used (nbf claim)
        ->expiresAt($time + config('auth.expire_time')) // Configures the expiration time of the token (exp claim)
        ->withClaim('username', $this->username) // Configures a new claim, called "uid"
        ->getToken($signer, new Key(config('auth.key'))); // Retrieves the generated token
    }

    //验证,10006：无权限
    public function checkLogin()
    {
        $time = time();
        $data = new ValidationData();
        $data->setIssuer('http://api.yifeng.deve');
        $data->setId('apiyifengcom');
        $data->setCurrentTime($time + 60);
        $signer = new Sha256();
        if ($this->token->verify($signer, config('auth.key')) === true && $this->token->validate($data) === true) {
            //判断用户的时实状态
            $status = User::where("username", '=', $this->username)->value("status");
            if ($status) {
                throw new HttpExceptions(403, "账号已冻结", 200000);
            }
            return true;
        } else {
            throw new HttpExceptions(403, "无权限(JWT)", 200000);
        }
    }
}