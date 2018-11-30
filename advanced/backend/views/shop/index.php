<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form=ActiveForm::begin(
    ['action'=>'/yii2/advanced/backend/web/index.php?r=/shop/add']
)?>

<?=$form->field($model,'name')->label('商品分类')->textInput(['style'=>'width:250px'])?>

<?=$form->field($model,'num')->label('商品数量')->textInput(['style'=>'width:250px'])?>

<?=$form->field($model,'address')->label('生产地址')->textInput(['style'=>'width:250px'])?>

<?=$form->field($model,'img')->label('商品图片')->fileInput(['class'=>'btn btn-default'])?>

<div class="form-group">
    <?=Html::submitButton('点击添加',['class'=>'btn btn-info'])?>
</div>

<?php ActiveForm::end()?>


