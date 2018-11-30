<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form=ActiveForm::begin()?>

    <?=Html::a('获取access_token',['/weixin/token'],['class'=>'btn btn-primary'])?>

    <?=Html::a('创建菜单',['/weixin/show'],['class'=>'btn btn-primary'])?>

    <?=Html::a('查询接口',['/weixin/get-menu'],['class'=>'btn btn-success'])?>

    <?=Html::a('获取用户信息',['/weixin/get-user-msg'],['class'=>'btn btn-info'])?>

    <?=Html::a('群发图文消息',['/weixin/group-message'],['class'=>'btn btn-default'])?>

    <?=Html::a('上传临时素材',['/weixin/add-sucai'],['class'=>'btn btn-success'])?>

    <?=Html::a('微信菜单添加页',['/weixin/add'],['class'=>'btn btn-primary'])?>

<?php ActiveForm::end()?>


