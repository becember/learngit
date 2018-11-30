<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form=ActiveForm::begin(

    [
        'action'=>'/yii2/advanced/backend/web/?r=/month/add-menu',
    ]

)?>

<?//=$form->field($model,'name')->label('一级菜单')->textInput(['style'=>'width:200px'])?>

<?=$form->field($model,'name')->label('菜单名称')->textInput(['style'=>'width:200px'])?>

<?=$form->field($model,'type')->label('菜单类型')->dropDownList(['点击事件'=>'点击事件','视图事件'=>'视图事件'],['style'=>'width:200px'])?>

<?=$form->field($model,'key')->label('事件内容')->textInput(['style'=>'width:200px'])?>

<div class="form-group">
    <?=Html::submitButton('新增菜单',['class'=>'btn btn-primary'])?>
</div>

<?php ActiveForm::end()?>
