<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\BaseHtml;
?>
<?php $form=ActiveForm::begin()?>

<?=$form->field($model,'button')->label('一级菜单名称')->textInput()?>
<?=$form->field($model,'type')->label('菜单类型')->dropDownList(['',''])?>
<?=$form->field($model,'name')->label('事件内容')->textInput()?>

<?php $form=ActiveForm::end()?>
