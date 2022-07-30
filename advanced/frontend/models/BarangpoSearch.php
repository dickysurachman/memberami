<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Barangpo;

/**
 * BarangpoSearch represents the model behind the search form of `app\models\Barangpo`.
 */
class BarangpoSearch extends Barangpo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_perusahaan', 'id_user', 'status', 'add_who', 'edit_who'], 'integer'],
            [['tanggal', 'kode', 'dari', 'keterangan', 'add_date', 'edit_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Barangpo::find();

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
            'tanggal' => $this->tanggal,
            'id_perusahaan' => $this->id_perusahaan,
            'id_user' => $this->id_user,
            'status' => $this->status,
            'add_who' => $this->add_who,
            'add_date' => $this->add_date,
            'edit_who' => $this->edit_who,
            'edit_date' => $this->edit_date,
        ]);

        $query->andFilterWhere(['like', 'kode', $this->kode])
            ->andFilterWhere(['like', 'dari', $this->dari])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
