<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Matakuliah;

/**
 * MatakuliahSearch represents the model behind the search form about `common\models\Matakuliah`.
 */
class MatakuliahSearch extends Matakuliah
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode', 'nama_mk', 'sks', 'semester_mk', 'gangen', 'kelompok_mk', 'prasyarat'], 'safe'],
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
        $query = Matakuliah::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'kode', $this->kode])
            ->andFilterWhere(['like', 'nama_mk', $this->nama_mk])
            ->andFilterWhere(['like', 'sks', $this->sks])
            ->andFilterWhere(['like', 'semester_mk', $this->semester_mk])
            ->andFilterWhere(['like', 'gangen', $this->gangen])
            ->andFilterWhere(['like', 'kelompok_mk', $this->kelompok_mk])
            ->andFilterWhere(['like', 'prasyarat', $this->prasyarat]);

        return $dataProvider;
    }
}
