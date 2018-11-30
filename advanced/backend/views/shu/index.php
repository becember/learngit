<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin()?>

<?= $form->field($model,'name')->textInput()?>

<?= $form->field($model,'pwd')->passwordInput()?>

<?= $form->field($model,'age')->textInput()?>

<?= $form->field($model,'sex')->dropDownList(['男','女'])?>

<?= $form->field($model,'email')->textInput()?>

<div class="form-group">

    <?=Html::submitButton('添加',['class'=>'btn btn-primary'])?>

</div>

<?php ActiveForm::end()?>
