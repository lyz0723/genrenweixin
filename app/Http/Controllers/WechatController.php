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
        'encodingaeskey'=>'04Nk35v28dI1HlfNofwArA0tKdakFEcUk32dUT4qtmP', //填写加密用的EncodingAESKey
        'appid'=>'wx31343af4538e0e1a', //填写高级调用功能的app id
        'appsecret'=>'d4c6f9adb1ff19100889ff702622089c ' //填写高级调用功能的密钥
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