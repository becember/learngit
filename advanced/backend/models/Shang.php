<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "shang".
 *
 * @property int $id
 * @property string $name
 * @property int $age
 * @property string $sex
 * @property string $email
 * @property string $pwd
 */
class Shang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['age'], 'integer'],
            [['name', 'sex', 'email', 'pwd'], 'string', 'max' => 35],
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
            'age' => 'Age',
            'sex' => 'Sex',
            'email' => 'Email',
            'pwd' => 'Pwd',
        ];
    }
}
