<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Project;
use hscstudio\mimin\components\Mimin;
/**
 * ProjectSearch represents the model behind the search form about `app\models\Project`.
 */
class ProjectSearch extends Project
{
    /**
     * @inheritdoc
     */
     public $tgl_a;
    public $tgl_b;
    public $kuartal;
    public function rules()
    {
        return [
            [['id', 'status','id_user'], 'integer'],
            [['nama','id_costumer', 'tanggal','kuartal', 'deskripsi', 'tanggal_deadline','tgl_a','tgl_b'], 'safe'],
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
        $query = Project::find();

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
            'id_user' => $this->id_user,
            'id_costumer' => $this->id_costumer,
            'tanggal' => $this->tanggal,
            'jumlah' => $this->jumlah,
            'status' => $this->status,
            'tanggal_deadline' => $this->tanggal_deadline,
        ]);
        } else {

       $query->andFilterWhere([
            'id' => $this->id,
            'id_user' => Yii::$app->user->identity->id,
            'id_costumer' => $this->id_costumer,
            'tanggal' => $this->tanggal,
            'jumlah' => $this->jumlah,
            'status' => $this->status,
            'tanggal_deadline' => $this->tanggal_deadline,
        ]);
        }

        if($this->kuartal=="Q1"){
            $query->andFilterWhere(['>=','month(tanggal)',1])
            ->andFilterWhere(['<=','month(tanggal)',3]);

        } else if($this->kuartal=="Q2"){
            $query->andFilterWhere(['>=','month(tanggal)',4])
            ->andFilterWhere(['<=','month(tanggal)',6]);

        } else if($this->kuartal=="Q3"){
            $query->andFilterWhere(['>=','month(tanggal)',7])
            ->andFilterWhere(['<=','month(tanggal)',9]);

        } else if($this->kuartal=="Q4"){
            $query->andFilterWhere(['>=','month(tanggal)',10])
            ->andFilterWhere(['<=','month(tanggal)',12]);

        }

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'deskripsi', $this->deskripsi]);

        return $dataProvider;
    }
}
