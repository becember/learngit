<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "shu".
 *
 * @property int $id
 * @property string $name
 * @property string $pwd
 * @property int $age
 * @property string $sex
 * @property string $email
 */
class Shu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'age'], 'integer'],
            [['email'],'email'],
            [['name', 'pwd'], 'string', 'max' => 35],
            [['sex'], 'string', 'max' => 25],
            [['id'], 'unique'],
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
            'pwd' => 'Pwd',
            'age' => 'Age',
            'sex' => 'Sex',
            'email' => 'Email',
        ];
    }
}
