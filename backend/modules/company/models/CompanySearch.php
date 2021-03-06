<?php

namespace backend\modules\company\models;

use common\classes\Debug;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\company\models\Company;

/**
 * CompanySearch represents the model behind the search form about `backend\modules\company\models\Company`.
 */
class CompanySearch extends Company
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dt_add', 'dt_update', 'status', 'lang_id', 'region_id'], 'integer'],
            [['name', 'address', 'email', 'photo', 'descr', 'slug', 'vip'], 'safe'],
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
        $role = Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
        $query = Company::find()->with('allPhones');
        //Debug::prn($query->where(['user_id' => Yii::$app->user->id]));

        if (isset($role['Редактор компаний'])) {
            $query->andWhere(['user_id' => Yii::$app->user->id]);
        }
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
        //

        if (!empty($this->name)) {
            $query->andWhere(['id' => $this->name]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'dt_add' => $this->dt_add,
            'dt_update' => $this->dt_update,
            'status' => $this->status,
            'lang_id' => $this->lang_id,
            'region_id' => $this->region_id,
        ]);

        $query
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'descr', $this->descr])
            /*->andFilterWhere(['like', 'slug', $this->slug])*/
            ->andFilterWhere(['like', 'vip', $this->vip]);


        $query->orderBy('dt_add DESC');
        return $dataProvider;
    }
}
