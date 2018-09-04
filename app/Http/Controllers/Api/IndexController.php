<?php
/**
 * Created by PhpStorm.
 * User: jerry
 * Date: 2018/9/3
 * Time: 下午10:38
 */

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class IndexController extends ApiController
{
    public function index()
    {
      return $this->message('请求成功');
    }

    public function login()
    {
        if (Auth::attempt([
            'email' => request('email'),
            'password' => request('password')])) {

            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            return $this->success($success);
        }else{
            return $this->unauthorised();
        }
    }

    public function register(Request $request)
    {
        $validator =Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->error();
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::created($input);
        $success['token'] = $user->createdToken('MyApp')->accessTokne;
        $success['name']  = $user->name();

        return $this->success($success);
    }

    public function getDetails()
    {
        $user = Auth::user();
        return $this->success($user);
    }
}