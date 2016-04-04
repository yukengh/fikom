<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Prodi;

/**
 * ProdiSearch represents the model behind the search form about `common\models\Prodi`.
 */
class ProdiSearch extends Prodi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_jenjang', 'kode'], 'safe'],
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
        $query = Prodi::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'nama_jenjang', $this->nama_jenjang])
            ->andFilterWhere(['like', 'kode', $this->kode]);

        return $dataProvider;
    }  
    
    public function searchProdiMatakuliah($params, $prodi)
    {
        $query = Pengampu::find()
                ->where('prodi_nama_jenjang = :prodi', [':prodi' => $prodi])
                ->orderBy('semester_mk');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
/*
        $query->andFilterWhere(['like', 'matakuliah_kode', $this->matakuliah_kode])
            ->andFilterWhere(['like', 'nama_mk', $this->nama_mk])
            ->andFilterWhere(['like', 'sks', $this->sks])
            ->andFilterWhere(['like', 'semester_mk', $this->semester_mk])
            ->andFilterWhere(['like', 'prodi_nama_jenjang', $this->prodi_nama_jenjang])
            ->andFilterWhere(['like', 'dosen_nidn', $this->dosen_nidn])
            ->andFilterWhere(['like', 'nama_pengampu', $this->nama_pengampu]);
        
  */      return $dataProvider;
    }    
    
    
}
