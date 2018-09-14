<?php
/**
 * Created by PhpStorm.
 * User: cc
 * Date: 2018/9/14
 * Time: 9:49
 */

namespace App\Http\Controllers\Api;


use http\Env\Response;
use Illuminate\Http\Request;

class WeixinController
{
    public function index(Request $request)
    {
        $signature = $request->input('signature');
        $timestamp = $request->input('timestamp');
        $nonce = $request->input('nonce');
//        $echostr = $request->input('echostr');
        $token = 'cscscs';

        $tmpArr =  array($timestamp, $nonce, $token);
        sort($tmpArr,SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($signature != $tmpStr) {
            return response()->json('false');
        }

        return response()->json('true');
    }
}