<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "prodi".
 *
 * @property string $nama_jenjang
 * @property string $kode
 *
 * @property Dosen[] $dosens
 * @property Mahasiswa[] $mahasiswas
 * @property Pengampu[] $pengampus
 */
class Prodi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prodi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_jenjang'], 'required'],
            [['nama_jenjang'], 'string', 'max' => 35],
            [['kode'], 'string', 'max' => 5]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nama_jenjang' => 'Nama Jenjang',
            'kode' => 'Kode',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDosens()
    {
        return $this->hasMany(Dosen::className(), ['homebase' => 'nama_jenjang']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMahasiswas()
    {
        return $this->hasMany(Mahasiswa::className(), ['prodi_jenjang' => 'nama_jenjang']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPengampus()
    {
        return $this->hasMany(Pengampu::className(), ['prodi_nama_jenjang' => 'nama_jenjang']);
    }
}
