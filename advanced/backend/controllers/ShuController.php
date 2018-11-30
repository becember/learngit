<?php
/**
 * Created by PhpStorm.
 * User: May
 * Date: 2018/11/16
 * Time: 20:29
 */

namespace backend\controllers;

use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use backend\models\Shu;
class ShuController extends Controller
{
    public function actionIndex(){
        $model = new Shu();
        if ($model->load(Yii::$app->request->post())){
            $res = Yii::$app->request->post();
            if (empty($res['_csrf'])){
                echo "有误!";
                die;
            }else{
                unset($res['_csrf']);
            }
            $data['name'] = $res['Shu']['name'];
            $data['pwd'] = md5($res['Shu']['pwd']);
            $data['age'] = $res['Shu']['age'];
            $data['sex'] = $res['Shu']['sex'];
            $data['email'] = $res['Shu']['email'];
            $db = Yii::$app->db;
            $data = $db->createCommand()->insert('shu',$data)->execute();
            if ($data){
                return $this->success(['shu/show']);
            }else{
                return $this->error('操作有误!');
            }
        }else{
            return $this->render('index',['model'=>$model]);
        }
    }
    public function actionShow()
    {
        $query = Shu::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $countries = $query->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('show', [
            'countries' => $countries,
            'pagination' => $pagination,
        ]);
    }
    public function actionDel(){
        $id = Yii::$app->request->get();
        $id = $id['id'];
        $res = Shu::deleteAll(['id'=>"$id"]);
        if ($res){
            return $this->success(['/shu/show']);
        }else{
            return $this->error('数据库操作失误');
        }
    }
    public function actionDelete(){

    }
}
