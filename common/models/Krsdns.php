<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "krsdns".
 *
 * @property integer $id
 * @property string $tahun_akademik
 * @property string $semester
 * @property string $mahasiswa_npm
 * @property string $nama_mhs
 * @property string $prodi_nama_jenjang
 * @property string $dosen_wali
 * @property string $total_sks
 * @property string $ips
 * @property string $ipk
 * @property string $sks_berikutnya
 *
 * @property Mahasiswa $mahasiswaNpm
 * @property KrsdnsDetail[] $krsdnsDetails
 */
class Krsdns extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'krsdns';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tahun_akademik', 'semester', 'mahasiswa_npm', 'prodi_nama_jenjang'], 'required'],
            [['tahun_akademik'], 'string', 'max' => 15],
            [['semester', 'ips', 'ipk'], 'string', 'max' => 6],
            [['mahasiswa_npm'], 'string', 'max' => 9],
            [['nama_mhs'], 'string', 'max' => 65],
            [['prodi_nama_jenjang'], 'string', 'max' => 35],
            [['dosen_wali'], 'string', 'max' => 45],
            [['total_sks', 'sks_berikutnya'], 'string', 'max' => 3]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tahun_akademik' => 'Thn Akdmk',
            'semester' => 'SMT',
            'mahasiswa_npm' => 'NPM',
            'nama_mhs' => 'Nama Mhs',
            'prodi_nama_jenjang' => 'Prodi',
            'dosen_wali' => 'Dosen Wali',
            'total_sks' => 'Ttl Sks',
            'ips' => 'IPS',
            'ipk' => 'IPK',
            'sks_berikutnya' => 'Next Sks',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMahasiswaNpm()
    {
        return $this->hasOne(Mahasiswa::className(), ['npm' => 'mahasiswa_npm']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKrsdnsDetails()
    {
        return $this->hasMany(KrsdnsDetail::className(), ['krsdns_id' => 'id']);
    }  
}
