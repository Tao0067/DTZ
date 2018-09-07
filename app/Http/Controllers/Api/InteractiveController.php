<?php
/**
 * Created by PhpStorm.
 * User: cc
 * Date: 2018/9/7
 * Time: 10:01
 */

namespace App\Http\Controllers\Api;


use GuzzleHttp\Client;

class InteractiveController extends ApiController
{
    public function index()
    {
        $http = new Client();
        $url = 'http://www.dtz.com/api/index';
        $response = $http->get($url);
        $data = json_decode((string)$response->getBody(), true);
        return $this->success($data);
//        return $this->message('ok');
    }
}