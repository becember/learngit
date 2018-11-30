<?php
/**
 * Created by PhpStorm.
 * User: May
 * Date: 2018/11/23
 * Time: 15:41
 */

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Shop;
class ShopController extends Controller
{
    public function actionIndex(){
        $model = new Shop();
        return $this->render('index',['model'=>$model]);
    }
    public function actionAdd(){
        $res = Yii::$app->request->post();
        print_r($res);die;
    }
}