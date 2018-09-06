<?php
/**
 * Created by PhpStorm.
 * User: cc
 * Date: 2018/9/5
 * Time: 17:38
 */
namespace App\Http\Middleware;

use App\Http\Controllers\Api\ApiController;
use Closure;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class CheckToken  extends ApiController
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {  //获取到用户数据，并赋值给$user
                return $this->notFond();
            }
            //如果想向控制器里传入用户信息，将数据添加到$request里面
//            $request->attributes->add($request);//添加参数
            return $next($request);

        } catch (TokenExpiredException $e) {

            return $this->unauthorised('Token overdue');

        } catch (TokenInvalidException $e) {

            return $this->unauthorised('Token Invalid');  //token无效


        } catch (JWTException $e) {

            return $this->unauthorised('Be short of token '); //token为空

        }


    }
}