<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Shang */

$this->title = 'Create Shang';
$this->params['breadcrumbs'][] = ['label' => 'Shangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shang-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
