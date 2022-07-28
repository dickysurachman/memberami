<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Training;
use hscstudio\mimin\components\Mimin;
/**
 * TrainingSearch represents the model behind the search form about `app\models\Training`.
 */
class TrainingSearch extends Training
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','id_user'], 'integer'],
            [['tanggal_r', 'status', 'keterangan', 'nama','id_costumer'], 'safe'],
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
        $query = Training::find();

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
            'tanggal_r' => $this->tanggal_r,
            'id_user' => $this->id_user,
            'id_costumer' => $this->id_costumer,
        ]);
        } else {


            $query->andFilterWhere([
            'id' => $this->id,
            'tanggal_r' => $this->tanggal_r,
            'id_costumer' => $this->id_costumer,
            'id_user' => Yii::$app->user->identity->id,
        ]);
        }

        

        $query->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'nama', $this->nama]);

        return $dataProvider;
    }
}
