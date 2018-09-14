<?php
/**
 * Created by PhpStorm.
 * User: cc
 * Date: 2018/9/14
 * Time: 9:49
 */

namespace App\Http\Controllers\Api;


use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class WeixinController extends ApiController
{
    public function index(Request $request)
    {
        $signature = $request->input('signature');
        $timestamp = $request->input('timestamp');
        $nonce = $request->input('nonce');
        $echostr = $request->input('echostr');
        $token = 'hnct';
//        Log::info($request->all());

        $tmpArr =  array($timestamp, $nonce, $token);
        sort($tmpArr);
        $tmpStr = implode('',$tmpArr);
        $tmpStr = sha1($tmpStr);
//        Log::info($tmpStr);
        if ($signature == $tmpStr) {
            echo $echostr;

        }

    }

    public function accessToken()
    {

        if (Redis::EXISTS('wx_accessToken')) {
            return Redis::GET('wx_accessToken');
        }else{
            $http = new Client();
            $url  = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential";
            $url .='&appid='.env('WX_APP_ID');
            $url .='&secret='.env('WX_APP_SECRET');

            $response  = $http->get($url);
            $data = json_decode((string)$response->getBody(), true);

            Redis::SETEX('wx_accessToken',7200,$data['access_token']);
            return $data['access_token'];
        }

    }


    public function getAccessToken()
    {
        $accessToken = $this->accessToken();

        return $this->success(['accesstoken' =>$accessToken]);
    }



}