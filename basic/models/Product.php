<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string $price
 * @property int $created_at
 */
class Product extends \yii\db\ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_DEFAULT = 'default';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT => ['id', 'name'],
            self::SCENARIO_CREATE => ['id', 'name', 'price'],
            self::SCENARIO_UPDATE => ['id', 'name'],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'created_at',], 'required'],
            [['price'], 'integer', 'min' => 1, 'max => 999'],
            [['name'], 'string', 'max' => 20, 'on' => self::SCENARIO_DEFAULT],
            [['name'], 'filter', 'filter' => function ($value) {
                return trim($value);
            }],
            [['name'], 'filter', 'filter' => function ($value) {
                return strip_tags($value);
            }]
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
            'price' => 'Price',
            'created_at' => 'Created At',
        ];
    }
}
