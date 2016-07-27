<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/8
 * Time: 21:08
 */
namespace App\Http\Controllers;
use wechatCallbackapiTest;
class IndexController extends Controller{
    public function index(){
        //define("TOKEN", "weixin");
        $wechatObj = new wechatCallbackapiTest();
        $obj=$wechatObj->valid();
        echo $obj;
    }
}