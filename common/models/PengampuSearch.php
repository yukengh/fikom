<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Pengampu;

/**
 * PengampuSearch represents the model behind the search form about `common\models\Pengampu`.
 */
class PengampuSearch extends Pengampu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['matakuliah_kode', 'nama_mk', 'sks', 'semester_mk', 'prodi_nama_jenjang', 'dosen_nidn', 'nama_pengampu'], 'safe'],
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
        $query = Pengampu::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'matakuliah_kode', $this->matakuliah_kode])
            ->andFilterWhere(['like', 'nama_mk', $this->nama_mk])
            ->andFilterWhere(['like', 'sks', $this->sks])
            ->andFilterWhere(['like', 'semester_mk', $this->semester_mk])
            ->andFilterWhere(['like', 'prodi_nama_jenjang', $this->prodi_nama_jenjang])
            ->andFilterWhere(['like', 'dosen_nidn', $this->dosen_nidn])
            ->andFilterWhere(['like', 'nama_pengampu', $this->nama_pengampu]);

        return $dataProvider;
    }
    
    public function search_for_dosen($params, $nidn)
    {
        $query = Pengampu::find()
                ->where(['dosen_nidn'=>  $nidn]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'matakuliah_kode', $this->matakuliah_kode])
            ->andFilterWhere(['like', 'nama_mk', $this->nama_mk])
            ->andFilterWhere(['like', 'sks', $this->sks])
            ->andFilterWhere(['like', 'semester_mk', $this->semester_mk])
            ->andFilterWhere(['like', 'prodi_nama_jenjang', $this->prodi_nama_jenjang])
            ->andFilterWhere(['like', 'dosen_nidn', $this->dosen_nidn])
            ->andFilterWhere(['like', 'nama_pengampu', $this->nama_pengampu]);

        return $dataProvider;
    }       
}
