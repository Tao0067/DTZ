<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class RefreshToken extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $this->checkForToken($request);

        try {

            if ($this->auth->parseToken()->authenticate()) {
                return $next($request);
            }

            throw new UnauthorizedException('Jwt-auth', '未登陆');
        } catch (TokenBlacklistedException $exception) {

            try {
                $token =   $this->auth->refresh();
                Auth::guard('api')->onceUsingId($this->auth->manager()->getPayloadFactory()->buildClaimsCollection()->toPlainArray('sub'));

            }catch (JWTException $exception) {
                throw new UnauthorizedException('Jwt-auth',$exception->getMessage());
            }

        }

        return $this->setAuthenticationHeader($next($request),$token);
    }
}
