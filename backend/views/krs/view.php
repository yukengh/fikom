<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Krsdns */

$this->title = 'KARTU RENCANA STUDI MAHASISWA (KRSM)';
$this->params['breadcrumbs'][] = ['label' => 'KRS', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="krsdns-view">

    <h3 style="text-align: center; font-weight: bold"><?= Html::encode($this->title) ?></h3>

    <p>
        <?php // Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php /* Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */?>
    </p>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          //  'id',
            'tahun_akademik',
            'semester',
            'mahasiswa_npm',
            'nama_mhs',
            'prodi_nama_jenjang',
            'dosen_wali',
            //'total_sks',
            //'ips',
            //'ipk',
            //'sks_berikutnya',
        ],
    ]) ?>
        </div>
        <div class="col-sm-3"></div>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'summary' => '',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
           // 'krsdns_id',
            'matakuliah_kode',
            'nama_mk',
            'sks',            
            'semester_mk',
            // 'gangen',
            'status',
            // 'nilai',
            // 'nilai_bobot',
            // 'jumlah_dns',
            'nama_pengampu',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>  
      
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'total_sks',
        ],
    ]) ?>   

</div>
