<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/8
 * Time: 21:08
 */
namespace App\Http\Controllers;
use App\libs\common;
class IndexController extends Controller{
    public function index(){
        define("TOKEN", "weixin");
        $wechatObj = new wechatCallbackapiTest();
        $wechatObj->valid();
        $obj=$wechatObj->responseMsg();
        echo $obj;
    }
}