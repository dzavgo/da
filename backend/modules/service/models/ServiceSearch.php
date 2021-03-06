<?php

namespace backend\modules\service\models;

use common\models\db\Products;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\services\models\Services;

/**
 * ServicesSearch represents the model behind the search form about `backend\modules\services\models\Services`.
 */
class ServiceSearch extends Products
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['title'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = $this::find()->where(['type' => self::TYPE_SERVICE]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
    const PRODUCT_PUBLISHED = 1;
    const PRODUCT_MODER = 0;
    const PRODUCT_DELETE = 3;


    public static function getTypes()
    {
        return [
            self::PRODUCT_PUBLISHED => 'Опубликован',
            self::PRODUCT_MODER => 'На модерации',
            self::PRODUCT_DELETE => 'Удален',
        ];
    }

    public static function getTypeLabel($type, $default = null)
    {
        $types = static::getTypes();
        return isset($types[$type]) ? $types[$type] : $default;
    }
}
