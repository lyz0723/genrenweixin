<?php

namespace App\Http\Controllers;

use DB;
use Log;
use Request;
use Session;
use App\Libs\Wechat;

class WechatController extends Controller
{
    public $wechatConfig = [
        'token'=>'weixin', //填写你设定的key
        //'encodingaeskey'=>'xJqP4GhKSpNThgdmz2TFxmp86z8Ju2l2', //填写加密用的EncodingAESKey
        'appid'=>'wx9036c924e93284c6', //填写高级调用功能的app id
        'appsecret'=>'b6ace35d7f3820f253b6c770d6a028e4' //填写高级调用功能的密钥
    ];

    public $wechatObj;

    public function __construct()
    {
        $this->wechatObj = new Wechat($this->wechatConfig);

        $this->wechatObj->getRev();

    }

    public function index()
    {
        $this->wechatObj->text('hello word')->reply();
    }
}