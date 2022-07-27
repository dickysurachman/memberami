<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Costumer;
use hscstudio\mimin\components\Mimin;
/**
 * CostumerSearch represents the model behind the search form about `app\models\Costumer`.
 */
class CostumerSearch extends Costumer
{
    /**
     * @inheritdoc
     */
    public $kotas;
    public function rules()
    {
        return [
            [['id','id_user'], 'integer'],
            [['nama', 'telp', 'alamat', 'person', 'person_c','id_city','id_segmen','kotas'], 'safe'],
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
        //$query = Costumer::find()->leftJoin('city', 'costumer.id_city = city.id');;
        $query = Costumer::find();//->leftJoin('city', 'costumer.id_city = city.id');;
        $query->joinWith(['city']);
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
            'costumer.id' => $this->id,
            'costumer.id_city'=>$this->id_city,
            'costumer.id_segmen'=>$this->id_segmen,
            'costumer.id_user' => $this->id_user,
        ]);
        } else {

        $query->andFilterWhere([
            'costumer.id' => $this->id,
            'id_city'=>$this->id_city,
            'id_segmen'=>$this->id_segmen,
            'id_user' => Yii::$app->user->identity->id,
        ]);
        }

        $query->andFilterWhere(['like', 'costumer.nama', $this->nama])
            ->andFilterWhere(['like', 'costumer.telp', $this->telp])
            ->andFilterWhere(['like', 'city.name', $this->kotas])
            ->andFilterWhere(['like', 'costumer.alamat', $this->alamat])
            ->andFilterWhere(['like', 'costumer.person', $this->person])
            ->andFilterWhere(['like', 'costumer.person_c', $this->person_c]);

        return $dataProvider;
    }
}
