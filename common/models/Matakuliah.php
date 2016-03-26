<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "matakuliah".
 *
 * @property string $kode
 * @property string $nama_mk
 * @property string $sks
 * @property string semester_mk
 * @property string $gangen
 * @property string $kelompok_mk
 * @property string $prasyarat
 *
 * @property Matakuliah $prasyarat0
 * @property Matakuliah[] $matakuliahs
 * @property Pengampu[] $pengampus
 */
class Matakuliah extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'matakuliah';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode', 'nama_mk', 'sks', 'gangen'], 'required'],
            [['kode', 'prasyarat'], 'string', 'max' => 9],
            [['nama_mk'], 'string', 'max' => 65],
            [['sks'], 'string', 'max' => 2],
            [['semester_mk', 'gangen'], 'string', 'max' => 6],
            [['kelompok_mk'], 'string', 'max' => 15],
            [['kode'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kode' => 'Kode',
            'nama_mk' => 'Nama Mk',
            'sks' => 'Sks',
            'semester_mk' => 'Smt',
            'gangen' => 'Gangen',
            'kelompok_mk' => 'Kelompok Mk',
            'prasyarat' => 'Prasyarat',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrasyarat0()
    {
        return $this->hasOne(Matakuliah::className(), ['kode' => 'prasyarat']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatakuliahs()
    {
        return $this->hasMany(Matakuliah::className(), ['prasyarat' => 'kode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPengampus()
    {
        return $this->hasMany(Pengampu::className(), ['matakuliah_kode' => 'kode']);
    }
    
    public function getSemester() {
        return [
            '1'=>'1',
            '2'=>'2',
            '3'=>'3',
            '4'=>'4',
            '5'=>'5',
            '6'=>'6',
            '7'=>'7',
            '8'=>'8',
        ];
    }
}
