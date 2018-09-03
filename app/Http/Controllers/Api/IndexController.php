<?php
/**
 * Created by PhpStorm.
 * User: jerry
 * Date: 2018/9/3
 * Time: 下午10:38
 */

namespace App\Http\Controllers\Api;


class IndexController extends ApiController
{
    public function index()
    {
      return $this->message('请求成功');
    }

}