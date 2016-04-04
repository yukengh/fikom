<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "krsdns_detail".
 *
 * @property integer $id
 * @property integer $krsdns_id
 * @property string $matakuliah_kode
 * @property string $nama_mk
 * @property string $semester_mk
 * @property string $sks
 * @property string $gangen
 * @property string $status
 * @property string $nilai
 * @property string $nilai_bobot
 * @property string $jumlah_dns
 * @property string $nama_pengampu
 *
 * @property Krsdns $krsdns
 * @property Matakuliah $matakuliahKode
 */
class KrsdnsDetail extends \yii\db\ActiveRecord
{
    public $tahun_akademik;
    public $semester;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'krsdns_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[/*'krsdns_id', */'matakuliah_kode', 'status'], 'required'],
            [['nilai'], 'required', 'on'=>'update'],
            [['krsdns_id'], 'integer'],
            [['matakuliah_kode'], 'string', 'max' => 9],
            [['nama_mk', 'nama_pengampu'], 'string', 'max' => 65],
            [['semester_mk', 'gangen'], 'string', 'max' => 6],
            [['sks', 'status', 'nilai', 'nilai_bobot', 'jumlah_dns'], 'string', 'max' => 2],
            ['matakuliah_kode', 'unique', 'targetAttribute' => ['krsdns_id', 'matakuliah_kode']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'krsdns_id' => 'Krsdns ID',
            'matakuliah_kode' => 'Kd MK',
            'nama_mk' => 'Nama MK',
            'semester_mk' => 'SMT',
            'sks' => 'SKS',
            'gangen' => 'Gangen',
            'status' => 'Status',
            'nilai' => 'Nilai',
            'nilai_bobot' => 'Nilai Bobot',
            'jumlah_dns' => 'Jumlah',
            'nama_pengampu' => 'Pengampu',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKrsdns()
    {
        return $this->hasOne(Krsdns::className(), ['id' => 'krsdns_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatakuliahKode()
    {
        return $this->hasOne(Matakuliah::className(), ['kode' => 'matakuliah_kode']);
    } 
    
    public function getNilai() {
        return [
            'A' => 'A',
            'B' => 'B',
            'C' => 'C',
            'D' => 'D',
            'E' => 'E'
        ];
    }
}
