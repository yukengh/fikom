<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dosen".
 *
 * @property string $nidn
 * @property string $nama_dosen
 * @property string $pangkat
 * @property string $homebase
 * @property string $email
 * @property string $foto
 * @property string $sks_diampu
 *
 * @property Prodi $homebase0
 * @property Mahasiswa[] $mahasiswas
 * @property Pengampu[] $pengampus
 */
class Dosen extends \yii\db\ActiveRecord
{
    public $file;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dosen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nidn', 'nama_dosen', 'homebase'], 'required'],
            [['nidn'], 'string', 'max' => 12],
            [['nidn'], 'number'],
            [['nama_dosen'], 'string', 'max' => 65],
            [['pangkat'], 'string', 'max' => 15],
            [['homebase'], 'string', 'max' => 35],
            [['email'], 'string', 'max' => 25],
            [['email'], 'email'],
            [['file'], 'file'],
            [['foto'], 'string', 'max' => 245],
            ['file', 'image', 'minWidth' => 500, 'maxWidth' => 600,'minHeight' => 600, 'maxHeight' => 800, 'extensions' => 'jpg, gif, png', 'maxSize' => 1024 * 1024 * 1],            
            [['sks_diampu'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nidn' => 'Nidn',
            'nama_dosen' => 'Nama Dosen',
            'pangkat' => 'Pangkat',
            'homebase' => 'Homebase',
            'email' => 'Email',
            'foto' => 'Foto',
            'sks_diampu' => 'SKS Diampu',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHomebase0()
    {
        return $this->hasOne(Prodi::className(), ['nama_jenjang' => 'homebase']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMahasiswas()
    {
        return $this->hasMany(Mahasiswa::className(), ['dosen_wali_nidn' => 'nidn']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPengampus()
    {
        return $this->hasMany(Pengampu::className(), ['dosen_nidn' => 'nidn']);
    }
}
