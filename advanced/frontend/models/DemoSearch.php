<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Demo;
use hscstudio\mimin\components\Mimin;
/**
 * DemoSearch represents the model behind the search form about `app\models\Demo`.
 */
class DemoSearch extends Demo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_costumer', 'status','id_user'], 'integer'],
            [['nama', 'tanggal', 'nama_ap'], 'safe'],
            [['jumlah'], 'number'],
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
        $query = Demo::find();

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
            'tanggal' => $this->tanggal,
            'id_costumer' => $this->id_costumer,
            'status' => $this->status,
            'jumlah' => $this->jumlah,
            'id_user' => $this->id_user,
        ]);
        } else {

       $query->andFilterWhere([
            'id' => $this->id,
            'tanggal' => $this->tanggal,
            'id_costumer' => $this->id_costumer,
            'status' => $this->status,
            'jumlah' => $this->jumlah,
            'id_user' => Yii::$app->user->identity->id,
        ]);
        }
        

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'nama_ap', $this->nama_ap]);

        return $dataProvider;
    }
}
