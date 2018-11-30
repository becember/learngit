<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ShangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shangs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shang-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Shang', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'age',
            'sex',
            'email:email',
            //'pwd',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
