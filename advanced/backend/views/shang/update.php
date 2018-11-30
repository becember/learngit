<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Shang */

$this->title = 'Update Shang: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Shangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="shang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
