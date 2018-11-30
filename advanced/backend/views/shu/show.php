<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<?=Html::a('添加',['/shu/index'],['class'=>'btn btn-primary'])?>
<table class="table table-top">
    <tr>
        <th>ID</th>
        <th>姓名</th>
        <th>年龄</th>
        <th>性别</th>
        <th>邮箱</th>
        <th>操作</th>
    </tr>
    <?php foreach ($countries as $country):?>
        <tr>
            <td><?=Html::encode("{$country->id}")?></td>
            <td><?=Html::encode("{$country->name}")?></td>
            <td><?=Html::encode("{$country->age}")?></td>
            <td><?=Html::encode("{$country->sex}")?></td>
            <td><?=Html::encode("{$country->email}")?></td>
            <td>
                <?=Html::a('删除',['/shu/del','id'=>"{$country->id}"],['class'=>'btn btn-primary'])?>
                <?=Html::a('修改',['/shu/upd','id'=>"{$country->id}"],['class'=>'btn btn-primary'])?>
<!--                <input class="btn btn-primary"  type="button" name="id"  value="ajax删除" onclick="check_del();">-->
               <!-- <script>
                    function button(){
                        var id = document.getElementById(id);
                        alert(id);
                        if(confirm("确认删除吗"))
                            $.ajax({
                                url : "?r=shu/delete",
                                type : 'get',
                                data : {
                                    id:id
                                },
                                dataType : 'json',
                                async : false,
                                success : function(data){
                                    if(data.status)
                                        window.location.reload();
                                    else
                                        alert("删除失败");
                                },
                                error : function(){
                                    alert("根本没有传过去");
                                }
                            });
                    }
                </script>-->
            </td>
        </tr>
    <?php endforeach;?>
</table>
<?= LinkPager::widget(['pagination' => $pagination]) ?>


