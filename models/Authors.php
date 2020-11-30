<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "authors".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $year
 * @property int|null $rating
 */
class Authors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['year', 'rating'], 'integer'],
            [['name'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя или псевдоним автора',
            'year' => 'Год рождения',
            'rating' => 'Рэйтинг',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function map($from, $to)
    {
        return ArrayHelper::map(self::find()->all(), $from, $to);
    }
}
