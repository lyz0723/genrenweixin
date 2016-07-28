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
    }
    public function index()
    {
        return Input::get('echostr');
    }

}
