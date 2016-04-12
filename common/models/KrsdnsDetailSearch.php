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
                ->select('`krsdns_detail`.matakuliah_kode, `krsdns_detail`.nama_mk, '
                        . '`krsdns_detail`.sks, `krsdns_detail`.semester_mk, `krsdns_detail`.nilai')
                ->innerJoinWith('krsdns')
                ->where('krsdns.mahasiswa_npm = :npm', [':npm'=>  $krsdns_npm])
                ->andWhere('krsdns_detail.nilai > "C"')
                ->andWhere('`krsdns_detail`.matakuliah_kode NOT IN(
                    SELECT `krsdns_detail`.matakuliah_kode FROM `krsdns_detail` 
                    INNER JOIN `krsdns` ON `krsdns_detail`.`krsdns_id` = `krsdns`.`id`
                    WHERE (`krsdns`.`mahasiswa_npm`= :npm) AND (krsdns_detail.nilai <= "C"))', [
                        ':npm' => $krsdns_npm
                    ]);     
        
     //   var_dump($query->prepare(Yii::$app->db->queryBuilder)->createCommand()->rawSql);
      //  die();         
        
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
    
    public function searchPerkembanganIpsIpk($params, $krsdns_npm)
    {
        $query = Krsdns::find()
                ->select('krsdns.tahun_akademik, krsdns.semester, krsdns.total_sks, '
                        . 'krsdns.sks_lulus, `krsdns`.ips, krsdns.ipk')
                ->innerJoinWith('krsdnsDetails')
                ->where('krsdns.mahasiswa_npm = :npm', [':npm'=>  $krsdns_npm])
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
    
    public function searchHistoriMkDiulangTidakLulus($params, $krsdns_npm)
    {
        $query = KrsdnsDetail::find()
                ->select('`krsdns_detail`.matakuliah_kode, `krsdns_detail`.nama_mk, '
                        . '`krsdns_detail`.sks, `krsdns_detail`.semester_mk, `krsdns_detail`.status, '
                        . '`krsdns_detail`.nilai, krsdns.tahun_akademik, krsdns.semester')
                ->innerJoinWith('krsdns')
                ->where('krsdns.mahasiswa_npm = :npm', [':npm'=>  $krsdns_npm])
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
            ->andFilterWhere(['like', 'nama_pengampu', $this->nama_pengampu])
            ->andFilterWhere(['like', 'tahun_akademik', $this->tahun_akademik])
            ->andFilterWhere(['like', 'semester', $this->semester]);        

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
