<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Mahasiswa;

/**
 * MahasiswaSearch represents the model behind the search form about `common\models\Mahasiswa`.
 */
class MahasiswaSearch extends Mahasiswa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['npm', 'nama_mhs', 'tpt_lahir_mhs', 'tgl_lahir_mhs', 'jk_mhs', 'agama_mhs', 'suku', 'prodi_jenjang', 'alamat_mhs', 'phone_mhs', 'email_mhs', 'asal_slta', 'jurusan_slta', 'status_masuk', 'status_kuliah', 'dosen_wali_nidn', 'dosen_wali_nama', 'foto', 'angkatan'], 'safe'],
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
        $query = Mahasiswa::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'tgl_lahir_mhs' => $this->tgl_lahir_mhs,
        ]);

        $query->andFilterWhere(['like', 'npm', $this->npm])
            ->andFilterWhere(['like', 'nama_mhs', $this->nama_mhs])
            ->andFilterWhere(['like', 'tpt_lahir_mhs', $this->tpt_lahir_mhs])
            ->andFilterWhere(['like', 'jk_mhs', $this->jk_mhs])
            ->andFilterWhere(['like', 'agama_mhs', $this->agama_mhs])
            ->andFilterWhere(['like', 'suku', $this->suku])
            ->andFilterWhere(['like', 'prodi_jenjang', $this->prodi_jenjang])
            ->andFilterWhere(['like', 'alamat_mhs', $this->alamat_mhs])
            ->andFilterWhere(['like', 'phone_mhs', $this->phone_mhs])
            ->andFilterWhere(['like', 'email_mhs', $this->email_mhs])
            ->andFilterWhere(['like', 'asal_slta', $this->asal_slta])
            ->andFilterWhere(['like', 'jurusan_slta', $this->jurusan_slta])
            ->andFilterWhere(['like', 'status_masuk', $this->status_masuk])
            ->andFilterWhere(['like', 'status_kuliah', $this->status_kuliah])
            ->andFilterWhere(['like', 'dosen_wali_nidn', $this->dosen_wali_nidn])
            ->andFilterWhere(['like', 'dosen_wali_nama', $this->dosen_wali_nama])
            ->andFilterWhere(['like', 'foto', $this->foto])
            ->andFilterWhere(['like', 'angkatan', $this->angkatan]);

        return $dataProvider;
    }
}
