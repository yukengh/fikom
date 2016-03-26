<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mahasiswa".
 *
 * @property string $npm
 * @property string $nama_mhs
 * @property string $tpt_lahir_mhs
 * @property string $tgl_lahir_mhs
 * @property string $jk_mhs
 * @property string $agama_mhs
 * @property string $suku
 * @property string $prodi_jenjang
 * @property string $alamat_mhs
 * @property string $phone_mhs
 * @property string $email_mhs
 * @property string $asal_slta
 * @property string $jurusan_slta
 * @property string $status_masuk
 * @property string $status_kuliah
 * @property string $dosen_wali_nidn
 * @property string $dosen_wali_nama
 * @property string $foto
 * @property string $angkatan
 *
 * @property Krsdns[] $krsdns
 * @property Dosen $dosenWaliNidn
 * @property Prodi $prodiJenjang
 */
class Mahasiswa extends \yii\db\ActiveRecord
{
    public $file;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mahasiswa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['npm', 'nama_mhs', 'prodi_jenjang', 'dosen_wali_nidn'], 'required'],
            [['tgl_lahir_mhs'], 'string', 'max' => 19],
            [['npm'], 'string', 'max' => 9],
            [['npm'], 'number'],
            [['nama_mhs'], 'string', 'max' => 65],
            [['tpt_lahir_mhs', 'dosen_wali_nama'], 'string', 'max' => 45],
            [['jk_mhs', 'dosen_wali_nidn'], 'string', 'max' => 12],
            [['agama_mhs'], 'string', 'max' => 20],
            [['suku', 'phone_mhs', 'jurusan_slta', 'status_masuk', 'status_kuliah'], 'string', 'max' => 15],
            [['phone_mhs'], 'number'],
            [['prodi_jenjang'], 'string', 'max' => 35],
            [['alamat_mhs'], 'string', 'max' => 145],
            [['email_mhs', 'asal_slta'], 'string', 'max' => 25],
            [['email_mhs'], 'email'],
            [['foto'], 'string', 'max' => 245],
            [['angkatan'], 'string', 'max' => 5],
            [['angkatan'], 'number'],
            [['npm'], 'unique'],
            [['file'], 'file'],
            [['foto'], 'string', 'max' => 245],
            ['file', 'image', 'minWidth' => 500, 'maxWidth' => 600,'minHeight' => 600, 'maxHeight' => 800, 'extensions' => 'jpg, gif, png', 'maxSize' => 1024 * 1024 * 1],            
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'npm' => 'Npm',
            'nama_mhs' => 'Nama',
            'tpt_lahir_mhs' => 'Tempat Lahir',
            'tgl_lahir_mhs' => 'Tanggal Lahir',
            'jk_mhs' => 'Jenis Kelamin',
            'agama_mhs' => 'Agama',
            'suku' => 'Suku',
            'prodi_jenjang' => 'Program Studi',
            'alamat_mhs' => 'Alamat',
            'phone_mhs' => 'No. Kontak',
            'email_mhs' => 'Email',
            'asal_slta' => 'Asal SLTA',
            'jurusan_slta' => 'Jurusan SLTA',
            'status_masuk' => 'Status Masuk USTJ',
            'status_kuliah' => 'Status Kuliah',
            'dosen_wali_nidn' => 'NIDN Dosen Wali',
            'dosen_wali_nama' => 'Nama Dosen Wali',
            'foto' => 'Foto',
            'angkatan' => 'Angkatan',
            'file' => 'Foto'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKrsdns()
    {
        return $this->hasMany(Krsdns::className(), ['mahasiswa_npm' => 'npm']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDosenWaliNidn()
    {
        return $this->hasOne(Dosen::className(), ['nidn' => 'dosen_wali_nidn']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdiJenjang()
    {
        return $this->hasOne(Prodi::className(), ['nama_jenjang' => 'prodi_jenjang']);
    }
}
