<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "month".
 *
 * @property int $id ID
 * @property int $pid 父级ID
 * @property string $name 名称
 * @property string $type 类型
 * @property string $key click等点击类型必须
 * @property string $url view、miniprogram类型必须
 */
class Month extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'month';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pid'], 'integer'],
            [['name', 'type'], 'string', 'max' => 35],
            [['key'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'key' => 'Key',
        ];
    }
}