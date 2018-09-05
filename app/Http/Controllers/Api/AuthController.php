<?php
/**
 * Created by PhpStorm.
 * User: cc
 * Date: 2018/9/5
 * Time: 14:10
 */

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use Auth;
use App\Models\User;


class AuthController extends ApiController
{
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:16'
        ];

        $params = $this->validate($request,$rules);

        if ($token = Auth::guard('api')->attempt($params)) {
            return $this->success(['token'=>'bearer '.$token]);
        }else{
            return $this->error();
        }
    }

    public function logout()
    {
        Auth::guard('api')->logout();
        return $this->message('退出成功');
    }

    public function getUserInfo()
    {
        $user = Auth::guard('api')->user();
        if ($user) {
            return $this->success($user);
        }else{
            return $this->unauthorised();
        }

    }
}