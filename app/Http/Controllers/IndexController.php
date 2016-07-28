<?php

namespace App\Http\Controllers;
//use App\Libs\wechatCallbackapiTest;
use Request;
use Input , Response;
class IndexController extends Controller{
    public function index(){
        // 1.将timestamp， nonce，token 按字典排序

        $timestamp =Input::get('timestamp');
        $nonce     = Input::get('nonce');
        $token     = 'weixin';
        $signature = Input::get('signature');
        $array     = array( $timestamp, $nonce, $token );
        sort( $array );
        // 2.将排序后的三个参数拼接之后用sha1加密
        $tmpstr    = implode('', $array);
        $tmpstr    = sha1( $tmpstr );
        // 3.将加密后的字符串与signature进行对比，判断该请求是否来自微信
        $echoster=$_GET['echostr'];
        if ( $tmpstr == $signature && $echoster) {
            echo $_GET['echostr'];
            exit;
        }else {
            $this -> responseMsg();
        }
    }
    public function responseMsg()
    {
        //get post data, May be due to the different environments
        //$postStr =   isset($GLOBALS["HTTP_RAW_POST_DATA"]) ?  $GLOBALS["HTTP_RAW_POST_DATA"]  : "" ;
        $postStr=Request::getContent();
        print_r($postStr);
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
            $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
            if(!empty( $keyword ))
            {
                $msgType = "text";
                $contentStr = "Welcome to wechat world!";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }else{
                echo "Input something...";
            }

        }else {
            echo "";
            exit;
        }
    }

}