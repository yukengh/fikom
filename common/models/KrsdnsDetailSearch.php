<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\KrsdnsDetail;

/**
 * KrsdnsDetailSearch represents the model behind the search form about `common\models\KrsdnsDetail`.
 */
class KrsdnsDetailSearch extends KrsdnsDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'krsdns_id'], 'integer'],
            [['matakuliah_kode', 'nama_mk', 'semester_mk', 'sks', 'gangen', 'status', 'nilai', 'nilai_bobot', 'jumlah_dns', 'nama_pengampu'], 'safe'],
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
        $query = KrsdnsDetail::find();

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
            'krsdns_id' => $this->krsdns_id,
        ]);

        $query->andFilterWhere(['like', 'matakuliah_kode', $this->matakuliah_kode])
            ->andFilterWhere(['like', 'nama_mk', $this->nama_mk])
            ->andFilterWhere(['like', 'semester_mk', $this->semester_mk])
            ->andFilterWhere(['like', 'sks', $this->sks])
            ->andFilterWhere(['like', 'gangen', $this->gangen])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'nilai', $this->nilai])
            ->andFilterWhere(['like', 'nilai_bobot', $this->nilai_bobot])
            ->andFilterWhere(['like', 'jumlah_dns', $this->jumlah_dns])
            ->andFilterWhere(['like', 'nama_pengampu', $this->nama_pengampu]);

        return $dataProvider;
    }
    
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search2($params, $krsdns_id)
    {
        $query = KrsdnsDetail::find()
                ->where(['krsdns_id'=>  $krsdns_id]);

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
            'krsdns_id' => $this->krsdns_id,
        ]);

        $query->andFilterWhere(['like', 'matakuliah_kode', $this->matakuliah_kode])
            ->andFilterWhere(['like', 'nama_mk', $this->nama_mk])
            ->andFilterWhere(['like', 'semester_mk', $this->semester_mk])
            ->andFilterWhere(['like', 'sks', $this->sks])
            ->andFilterWhere(['like', 'gangen', $this->gangen])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'nilai', $this->nilai])
            ->andFilterWhere(['like', 'nilai_bobot', $this->nilai_bobot])
            ->andFilterWhere(['like', 'jumlah_dns', $this->jumlah_dns])
            ->andFilterWhere(['like', 'nama_pengampu', $this->nama_pengampu]);

        return $dataProvider;
    }  
    
    public function searchMatakuliahSudahDikontrak($params, $krsdns_npm)
    {
        $query = KrsdnsDetail::find()
                ->joinWith('krsdns')
                ->where(['krsdns.mahasiswa_npm'=>  $krsdns_npm]);
        
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
            'krsdns_id' => $this->krsdns_id,
        ]);

        $query->andFilterWhere(['like', 'matakuliah_kode', $this->matakuliah_kode])
            ->andFilterWhere(['like', 'nama_mk', $this->nama_mk])
            ->andFilterWhere(['like', 'semester_mk', $this->semester_mk])
            ->andFilterWhere(['like', 'sks', $this->sks])
            ->andFilterWhere(['like', 'gangen', $this->gangen])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'nilai', $this->nilai])
            ->andFilterWhere(['like', 'nilai_bobot', $this->nilai_bobot])
            ->andFilterWhere(['like', 'jumlah_dns', $this->jumlah_dns])
            ->andFilterWhere(['like', 'nama_pengampu', $this->nama_pengampu]);

        return $dataProvider;
    }  
    
    public function searchMatakuliahBelumLulus($params, $krsdns_npm)
    {
        $query = KrsdnsDetail::find()
                ->joinWith('krsdns')
                ->where(['krsdns.mahasiswa_npm'=>  $krsdns_npm])
                ->andWhere('krsdns_detail.nilai > "C"');
        
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
            'krsdns_id' => $this->krsdns_id,
        ]);

        $query->andFilterWhere(['like', 'matakuliah_kode', $this->matakuliah_kode])
            ->andFilterWhere(['like', 'nama_mk', $this->nama_mk])
            ->andFilterWhere(['like', 'semester_mk', $this->semester_mk])
            ->andFilterWhere(['like', 'sks', $this->sks])
            ->andFilterWhere(['like', 'gangen', $this->gangen])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'nilai', $this->nilai])
            ->andFilterWhere(['like', 'nilai_bobot', $this->nilai_bobot])
            ->andFilterWhere(['like', 'jumlah_dns', $this->jumlah_dns])
            ->andFilterWhere(['like', 'nama_pengampu', $this->nama_pengampu]);

        return $dataProvider;
    }     
    
    public function searchMatakuliahBelumDikontrak($params, $krsdns_npm)
    {        
        $query = Pengampu::find()
                ->where('pengampu.matakuliah_kode not in (select krsdns_detail.matakuliah_kode 
                    from krsdns_detail left join krsdns on krsdns_detail.krsdns_id = krsdns.id 
                    where krsdns.mahasiswa_npm = :npm)', [':npm'=>$krsdns_npm]);        
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        return $dataProvider;
    }         
}
