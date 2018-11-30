<?php
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
use yii\helpers\Html;
?>
<div class="site-error">
    <div class="alert alert-danger page-none-alert">
        <p>
            <?php if(isset($errorMessage)):?>
                <span class="glyphicon glyphicon-remove-sign text-danger"></span>
                <span class="btn-lg text-danger"><?php echo '操作出错啦！' ?></span>
                <?php echo '<p>'.$errorMessage.'</p>';?>
            <?php else:?>
                <span class="glyphicon glyphicon-ok-sign text-success"></span>
                <span class="btn-lg text-success">恭喜！操作成功！</span>
            <?php endif;?>
        </p>
        <p class="text-muted">该页将在3秒后自动跳转!</p>
        <p>
            <?php if(isset($gotoUrl)):?>
                <a href="<?php echo $gotoUrl?>">立即跳转</a>
            <?php else:?>
                <a href="javascript:void(0)" onclick="history.go(-1)">返回上一页</a>
            <?php endif;?>
        </p>
    </div>
    <style>
        .page-none-alert{margin: 100px 0 !important;
            text-align: center !important;
            font-size: 30px !important;}
    </style>
</div>
<script>
    <?php if(!isset($gotoUrl)):?>
    setInterval("history.go(-1);",<?php echo $sec;?>000);
    <?php else:?>
    setInterval("window.location.href='<?php echo  $gotoUrl;?>'",<?php echo $sec;?>000);
    <?php endif;?>
</script>