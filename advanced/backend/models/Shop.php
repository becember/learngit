<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "shop".
 *
 * @property int $id ID
 * @property string $name 分类名称
 * @property int $num 商品数量
 * @property string $address 生产地址
 * @property string $img 商品图片
 */
class Shop extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['num'], 'integer'],
            [['name', 'address'], 'string', 'max' => 35],
            [['img'], 'string', 'max' => 50],
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
            'num' => 'Num',
            'address' => 'Address',
            'img' => 'Img',
        ];
    }
}