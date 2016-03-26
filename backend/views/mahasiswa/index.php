<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MahasiswaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mahasiswas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mahasiswa-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Mahasiswa', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'npm',
            'nama_mhs',
           // 'tpt_lahir_mhs',
           // 'tgl_lahir_mhs',
          //  'jk_mhs',
            // 'agama_mhs',
            // 'suku',
             'prodi_jenjang',
             'alamat_mhs',
             'phone_mhs',
             'email_mhs',
            // 'asal_slta',
            // 'jurusan_slta',
            // 'status_masuk',
             'status_kuliah',
            // 'dosen_wali_nidn',
           //  'dosen_wali_nama',
            // 'foto',
            // 'angkatan',
            [
                'attribute'=>'foto',
                'filter'=>false,
                'format' => ['image',['width'=>'40']],
            ],             

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
