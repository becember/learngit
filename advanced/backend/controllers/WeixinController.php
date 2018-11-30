<?php
/**
 * Created by PhpStorm.
 * User: May
 * Date: 2018/11/19
 * Time: 8:56
 */

namespace backend\controllers;

use Yii;
use curl\Curl;
use backend\models\Weekmenu;
use PHPUnit\Util\Log\JSON;
use yii\web\Controller;
use yii\web\Response;
class WeixinController extends Controller
{
    private $APPID='wx31321a44db1017ee';
    private $APPSECRET = '5a00f7a2b20b03315070e8244517e83f';
    private $tokenKey = "weixin_token";
    private $access_token='';
    public function init(){
        $this->access_token = Yii::$app->redis->get($this->tokenKey);
    }
    public function actionIndex(){
        return $this->render('index');
    }
    public function actionToken(){
        //用来请求HTTP响应头
        Yii::$app->response->format = Response::FORMAT_JSON;
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->APPID&secret=$this->APPSECRET";
        $curl = new Curl();
        $res = $curl->get($url);
        $result = array();
        if ($res){
            $result = json_decode($res);
        }
        $access_token = $result->access_token;
        $expires_in = $result->expires_in;
        $source = Yii::$app->redis->set($this->tokenKey,$access_token);
        if($source){
            Yii::$app->redis->expire($this->tokenKey,$expires_in);
        }
        return ['code'=>0,'message'=>$access_token];
    }
    public function actionAdd(){
        $model = new Weekmenu();
        return $this->render('add',['model'=>$model]);
    }
    public function actionShow(){
        $a = "蒋飞";
        $param = <<<JSON
        {
            "button": [
                {
                    "name": "$a",
                    "sub_button": [
                        {
                            "type": "scancode_waitmsg",
                            "name": "扫码带提示",
                            "key": "scancode_waitmsg",
                            "sub_button": [ ]
                        },
                        {
                            "type": "scancode_push",
                            "name": "扫码推事件",
                            "key": "scancode_push",
                            "sub_button": [ ]
                        }
                    ]
                },
                {
                    "name": "发图",
                    "sub_button": [
                        {
                            "type": "pic_sysphoto",
                            "name": "系统拍照发图",
                            "key": "pic_sysphoto",
                           "sub_button": [ ]
                         },
                        {
                            "type": "pic_photo_or_album",
                            "name": "拍照或者相册发图",
                            "key": "pic_photo_or_album",
                            "sub_button": [ ]
                        },
                        {
                            "type": "pic_weixin",
                            "name": "微信相册发图",
                            "key": "pic_weixin",
                            "sub_button": [ ]
                        }
                    ]
                },
                {
                    "name": "快捷操作",
                    "sub_button" : [
                        {
                            "name": "地理位置",
                            "type": "location_select",
                            "key": "location_select"
                        },
                        {
                            "name": "普通点击",
                            "type": "click",
                            "key": "click"
                        },
                        {
                            "name": "查看URL",
                            "type": "view",
                            "url" : "http://www.soso.com/"
                        },
                    ]
                },
            ]
        }
JSON;
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$this->access_token";
        $curl = new Curl();
        $curl->setRequestBody($param);
        $res = $curl->post($url,true);
        print_r($res);die;
    }
    public function actionGetMenu(){
        $url = "https://api.weixin.qq.com/cgi-bin/menu/get?access_token=$this->access_token";
        $curl = new Curl();
        $res = $curl->get($url);
        print_r($res);die;
    }
    public function actionGetUserMsg(){
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$this->access_token&openid=okP6P1uDTYG1vWNm91MSoHbVlQLA&lang=zh_CN";
        $curl = new Curl();
        $res = $curl->get($url);
        print_r(json_decode($res));die;
    }
    public function actionGroupMessage(){
        echo 1;die;
    }
    public function actionAddSucai(){

    }
    public function actionAddMenu(){

    }
}