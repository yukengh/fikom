<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Krsdns;

/**
 * KrsdnsSearch represents the model behind the search form about `common\models\Krsdns`.
 */
class KrsdnsSearch extends Krsdns
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['tahun_akademik', 'semester', 'mahasiswa_npm', 'nama_mhs', 'prodi_nama_jenjang', 'dosen_wali', 'total_sks', 'ips', 'ipk', 'sks_berikutnya'], 'safe'],
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
        $query = Krsdns::find()->where('ips IS NULL OR " " OR 0');

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

        $query->andFilterWhere(['like', 'tahun_akademik', $this->tahun_akademik])
            ->andFilterWhere(['like', 'semester', $this->semester])
            ->andFilterWhere(['like', 'mahasiswa_npm', $this->mahasiswa_npm])
            ->andFilterWhere(['like', 'nama_mhs', $this->nama_mhs])
            ->andFilterWhere(['like', 'prodi_nama_jenjang', $this->prodi_nama_jenjang])
            ->andFilterWhere(['like', 'dosen_wali', $this->dosen_wali])
            ->andFilterWhere(['like', 'total_sks', $this->total_sks])
            ->andFilterWhere(['like', 'ips', $this->ips])
            ->andFilterWhere(['like', 'ipk', $this->ipk])
            ->andFilterWhere(['like', 'sks_berikutnya', $this->sks_berikutnya]);

        return $dataProvider;
    }   
    
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */    
    public function searchProcessed($params)
    {
        $query = Krsdns::find()->where('ips IS Not NULL OR ips <> "" OR ips <> 0');

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

        $query->andFilterWhere(['like', 'tahun_akademik', $this->tahun_akademik])
            ->andFilterWhere(['like', 'semester', $this->semester])
            ->andFilterWhere(['like', 'mahasiswa_npm', $this->mahasiswa_npm])
            ->andFilterWhere(['like', 'nama_mhs', $this->nama_mhs])
            ->andFilterWhere(['like', 'prodi_nama_jenjang', $this->prodi_nama_jenjang])
            ->andFilterWhere(['like', 'dosen_wali', $this->dosen_wali])
            ->andFilterWhere(['like', 'total_sks', $this->total_sks])
            ->andFilterWhere(['like', 'ips', $this->ips])
            ->andFilterWhere(['like', 'ipk', $this->ipk])
            ->andFilterWhere(['like', 'sks_berikutnya', $this->sks_berikutnya]);

        return $dataProvider;
    }      
}
