<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Person;
use hscstudio\mimin\components\Mimin;
/**
 * PersonSearch represents the model behind the search form about `app\models\Person`.
 */
class PersonSearch extends Person
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_user'], 'integer'],
            [['id_costumer','nama', 'telp', 'email'], 'safe'],
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
        $query = Person::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
         if(Mimin::checkRoute('userk/create')) {
        $query->andFilterWhere([
            'id' => $this->id,
            'id_costumer' => $this->id_costumer,
            'id_user' => $this->id_user,
        ]);

         } else {
        $query->andFilterWhere([
            'id' => $this->id,
            'id_costumer' => $this->id_costumer,
            'id_user' => Yii::$app->user->identity->id,
        ]);

         }

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'telp', $this->telp])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
