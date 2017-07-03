<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "tariff".
 *
 * @property integer $id
 * @property string $name
 * @property string $descr
 * @property integer $price
 * @property integer $published
 *
 * @property TariffServicesRelations[] $tariffServicesRelations
 */
class Tariff extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tariff';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'price'], 'required'],
            [['descr'], 'string'],
            [['price', 'published'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'descr' => 'Descr',
            'price' => 'Price',
            'published' => 'Published',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTariffServicesRelations()
    {
        return $this->hasMany(TariffServicesRelations::className(), ['tariff_id' => 'id']);
    }
}
