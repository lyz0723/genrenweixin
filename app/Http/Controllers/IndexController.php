<?php

namespace App\Http\Controllers;
use App\Libs\wechatCallbackapiTest;
class IndexController extends Controller{
    public function index(){
        define("TOKEN", "weixin");
        $wechatObj = new wechatCallbackapiTest();
        $wechatObj->valid();
         $wechatObj->responseMsg();
    }
}