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
    
    public function searchMkSudahDikontrak($params)
    {
        $query = Krsdns::find()
                ->select('mahasiswa_npm, nama_mhs, prodi_nama_jenjang, dosen_wali')
                ->where('ips IS Not NULL OR ips <> "" OR ips <> 0')
                ->distinct();

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
    
    public function searchPerkembanganIpsIpk($params)
    {
        $query = Krsdns::find()
                ->select('mahasiswa_npm, nama_mhs, prodi_nama_jenjang, dosen_wali')
                ->where('ips IS Not NULL OR ips <> "" OR ips <> 0')
                ->distinct();

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
    
    public function searchMkBelumLulus($params)
    {
        $query = Krsdns::find()
                ->select('mahasiswa_npm, nama_mhs, prodi_nama_jenjang, dosen_wali')
                ->innerJoinWith('krsdnsDetails')
                ->where('ips IS Not NULL OR ips <> "" OR ips <> 0')
                ->andWhere('krsdns_detail.nilai > "C"')
                ->andWhere('`krsdns_detail`.matakuliah_kode NOT IN( SELECT `krsdns_detail`.matakuliah_kode 
                    FROM `krsdns_detail` INNER JOIN `krsdns` ON `krsdns_detail`.`krsdns_id` = `krsdns`.`id` 
                    WHERE (krsdns_detail.nilai <= "C"))')           
                ->distinct();     

     //   var_dump($query->prepare(Yii::$app->db->queryBuilder)->createCommand()->rawSql);
     //   die();
        

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
    
    public function searchMkBelumDikontrak($params)
    {
        $query = Krsdns::find()
                ->select('mahasiswa_npm, nama_mhs, prodi_nama_jenjang, dosen_wali')
                ->where('total_sks < (select sum(sks) from pengampu where prodi_nama_jenjang = krsdns.prodi_nama_jenjang)')
                ->distinct();        

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
    
    public function searchHistoriMkDiulangTidakLulus($params)
    {
        $query = Krsdns::find()
                ->select('mahasiswa_npm, nama_mhs, prodi_nama_jenjang, dosen_wali')
                ->innerJoinWith('krsdnsDetails')
                ->where('ips IS Not NULL OR ips <> "" OR ips <> 0')
                ->andWhere('krsdns_detail.nilai > "C"') 
                ->distinct();     

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
