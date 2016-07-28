<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Input , Response;
class WeixinController extends Controller
{
    public function __construct()
    {
        $this->beforeFilter('weixin', array('on' => 'get|post'));
        $this->responseMsg();
    }
    public function index()
    {
        return Input::get('echostr');

    }
    public function responseMsg()
    {
        //get post data, May be due to the different environments
        $postStr = $GLOBALS['HTTP_RAW_POST_DATA'];
        //extract post data
        if (!empty($postStr)){
            /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
               the best way is to check the validity of xml by yourself */
            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
            $time = time();
            //获取用户发送消息的类型
            $msgType  = $postObj->MsgType;
            //定义发送文字消息的接口
            $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";

            if($msgType=="text"){
                if(!empty( $keyword ))
                {
                    /*
                     * 图灵机器人
                     * */
                    //定义URL链接操作
                    $url="http://www.tuling123.com/openapi/api?key=1f3a6c1438f6935ea3344fc678cc509c&info=".$keyword;
                    $str=file_get_contents($url);
                    $json=json_decode($str,true);
                    //定义回复内容类型
                    $contentStr=$json['text'];
                    //格式化字符串
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
                    /*
                     * 图灵结束
                     * */
                }else{
                    echo "Input something...";
                }
            }
        }else {
            echo "";
            exit;
        }
    }
}
