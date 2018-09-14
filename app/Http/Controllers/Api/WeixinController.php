<?php
/**
 * Created by PhpStorm.
 * User: cc
 * Date: 2018/9/14
 * Time: 9:49
 */

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WeixinController
{
    public function index(Request $request)
    {
        $signature = $request->input('signature');
        $timestamp = $request->input('timestamp');
        $nonce = $request->input('nonce');
        $echostr = $request->input('echostr');
        $token = 'hnct';
        Log::info($request->all());

        $tmpArr =  array($timestamp, $nonce, $token);
        sort($tmpArr);
        $tmpStr = implode('',$tmpArr);
        $tmpStr = sha1($tmpStr);
        Log::info($tmpStr);

        if ($signature == $tmpStr) {
            Log::info($echostr);
            echo $echostr;
        }

    }
}