<?php
/**
 * Created by PhpStorm.
 * User: May
 * Date: 2018/11/23
 * Time: 14:10
 */

namespace backend\controllers;

use curl\Curl;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use backend\models\Month;

class MonthController extends Controller
{
    /**
     * @var string 设置属性
     */
    private $appid = "wx31321a44db1017ee";
    private $secret = "5a00f7a2b20b03315070e8244517e83f";
    private $tokenKey = "jiang";
    private $access_token = "";

    /**
     *  init设置token每次获取
     */
    public function init()
    {
        $this->access_token = Yii::$app->redis->get($this->tokenKey);
    }

    /**
     * @return array 获取access_token
     */
    public function actionGetToken(){
        //http设置响应头
        Yii::$app->response->format = Response::FORMAT_JSON;
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appid&secret=$this->secret";
        $curl = new Curl();
        $res = json_decode($curl->get($url));
        $result = array();
        if ($res){
            $result = $res;
        }
        $access_token = $result->access_token;
        $expires_in = $result->expires_in;
        //将接到的access_token放入redis
        $source = Yii::$app->redis->set($this->tokenKey,$access_token);
        if ($source){
            Yii::$app->redis->expire($this->tokenKey,$expires_in);
        }
        return ['code'=>0,'message'=>$access_token];
    }

    /**
     * @return string 直接重定向到页面
     */
    public function actionIndex(){
        $model = new Month();
        return $this->render('index',['model'=>$model]);
    }
    //接收表单值
    public function actionAddMenu()
    {
        $res = Yii::$app->request->post();
        if (empty($res)){
            die();
        }
        if (!empty($res['_csrf'])){
            unset($res['_csrf']);
        }else{
            echo "验证不合法";
        }
        $name = $res['Month']['name'];
        $type = $res['Month']['type'];
        $key = $res['Month']['key'];
        $pdo = new \PDO('mysql:host=118.25.193.128;dbname=advanced','root','root');
        $sql = "insert into month values(null,'$name','$type','$key')";
        $pdo->exec($sql);
        $sql1 = "select * from month";
        $data = $pdo->query($sql1);
        $param = <<<JSON
                  {
    "button": [
        {
            "name": "扫码", 
            "sub_button": [
                {
                    "type": "scancode_waitmsg", 
                    "name": "扫码带提示", 
                    "key": "rselfmenu_0_0", 
                    "sub_button": [ ]
                }, 
                {
                    "type": "scancode_push", 
                    "name": "扫码推事件", 
                    "key": "rselfmenu_0_1", 
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
                    "key": "rselfmenu_1_0", 
                   "sub_button": [ ]
                 }, 
                {
                    "type": "pic_photo_or_album", 
                    "name": "拍照或者相册发图", 
                    "key": "rselfmenu_1_1", 
                    "sub_button": [ ]
                }, 
                {
                    "type": "pic_weixin", 
                    "name": "微信相册发图", 
                    "key": "rselfmenu_1_2", 
                    "sub_button": [ ]
                }
            ]
        }
    ]
}
JSON;
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$this->access_token";
        $curl = new Curl();
        $curl->setRequestBody($param);
        $res = json_decode($curl->post($url),true);
        print_r($res);die;
    }
    public function actionDelMenu(){
        $url = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=$this->access_token";
        $curl = new Curl();
        $res = $curl->get($url);
        print_r($res);die;
    }
}