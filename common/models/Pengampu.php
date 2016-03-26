<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pengampu".
 *
 * @property integer $id
 * @property string $matakuliah_kode
 * @property string $nama_mk
 * @property string $sks
 * @property string semester_mk
 * @property string $prodi_nama_jenjang
 * @property string $dosen_nidn
 * @property string $nama_pengampu
 *
 * @property KrsdnsDetail[] $krsdnsDetails
 * @property Dosen $dosenNidn
 * @property Prodi $prodiNamaJenjang
 * @property Matakuliah $matakuliahKode
 */
class Pengampu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pengampu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['matakuliah_kode', 'prodi_nama_jenjang', 'dosen_nidn'], 'required'],
            [['matakuliah_kode'], 'string', 'max' => 9],
            [['nama_mk', 'nama_pengampu'], 'string', 'max' => 65],
            [['sks'], 'string', 'max' => 2],
            [['semester_mk'], 'string', 'max' => 6],
            [['prodi_nama_jenjang'], 'string', 'max' => 35],
            [['dosen_nidn'], 'string', 'max' => 12],
            ['matakuliah_kode', 'unique', 'targetAttribute' => ['matakuliah_kode', 'prodi_nama_jenjang']],            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'matakuliah_kode' => 'Kode MK',
            'nama_mk' => 'Nama Mk',
            'sks' => 'SKS',
            'semester_mk' => 'SMT',
            'prodi_nama_jenjang' => 'Prodi',
            'dosen_nidn' => 'NIDN',
            'nama_pengampu' => 'Pengampu',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKrsdnsDetails()
    {
        return $this->hasMany(KrsdnsDetail::className(), ['pengampu_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDosenNidn()
    {
        return $this->hasOne(Dosen::className(), ['nidn' => 'dosen_nidn']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdiNamaJenjang()
    {
        return $this->hasOne(Prodi::className(), ['nama_jenjang' => 'prodi_nama_jenjang']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatakuliahKode()
    {
        return $this->hasOne(Matakuliah::className(), ['kode' => 'matakuliah_kode']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKrsdns()
    {
        return $this->hasOne(Krsdns::className(), ['prodi_nama_jenjang' => 'prodi_nama_jenjang']);
    }    
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKrsdnsDetail()
    {
        return $this->hasOne(KrsdnsDetail::className(), ['matakuliah_kode' => 'matakuliah_kode']);
    }     
         
}
