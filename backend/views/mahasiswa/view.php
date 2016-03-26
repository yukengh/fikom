<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Mahasiswa */

$this->title = 'PROFILE MAHASISWA';
$this->params['breadcrumbs'][] = ['label' => 'Mahasiswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mahasiswa-view">

    <h3 style="text-align: center; font-weight: bold"><?= Html::encode($this->title) ?></h3>

    <div class="col-xs-4 col-sm-3 col-lg-2">
        <?= DetailView::widget([
            'model' => $model,
            'template'=>'<tr style="text-align: center"><td>{value}</td></tr>',
            'attributes' => [
                //'foto',
                [
                    'attribute'=>'foto',
                    'format' => ['image',['height'=>'190']],
                ],

            ],
        ]) ?>
    </div>    
    
    <div class="col-sm-9">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'npm',
                'nama_mhs',
                'tpt_lahir_mhs',
                'tgl_lahir_mhs',
                'jk_mhs',
                'agama_mhs',
                'suku',
                'prodi_jenjang',
                'alamat_mhs',
                'phone_mhs',
                'email_mhs:email',
                'asal_slta',
                'jurusan_slta',
                'status_masuk',
                'status_kuliah',
                //'dosen_wali_nidn',
                'dosen_wali_nama',
               // 'foto',
                'angkatan',
            ],
        ]) ?>
    </div>

</div>
