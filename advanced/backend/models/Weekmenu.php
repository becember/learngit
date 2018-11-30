<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "weekmenu".
 *
 * @property int $id ID
 * @property int $pid
 * @property string $button 一级菜单数组，个数应为1~3个
 * @property string $sub_button 二级菜单数组，个数应为1~5个
 * @property string $type 菜单的响应动作类型，view表示网页类型，click表示点击类型，miniprogram表示小程序类型
 * @property string $name 菜单标题，不超过16个字节，子菜单不超过60个字节
 */
class Weekmenu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'weekmenu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pid'], 'integer'],
            [['button', 'sub_button', 'type', 'name'], 'string', 'max' => 35],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pid' => 'Pid',
            'button' => 'Button',
            'sub_button' => 'Sub Button',
            'type' => 'Type',
            'name' => 'Name',
        ];
    }
}
