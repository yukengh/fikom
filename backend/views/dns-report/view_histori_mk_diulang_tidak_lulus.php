<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Krsdns */

$this->title = 'HISTORI MATAKULIAH DIULANG (TIDAK LULUS)';
$this->params['breadcrumbs'][] = ['label' => 'HISTORI MK DIULANG (TIDAK LULUS)', 'url' => ['index-histori-mk-diulang-tidak-lulus']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="krsdns-view">

    <h3 style="text-align: center; font-weight: bold"><?= Html::encode($this->title) ?></h3>

    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'mahasiswa_npm',
            'nama_mhs',
            'prodi_nama_jenjang',
            'dosen_wali',
        ],
    ]) ?>
        </div>
        <div class="col-sm-3"></div>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
      //  'filterModel' => $searchModel,
        'summary' => '',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'matakuliah_kode',
            'nama_mk',
            'sks',            
            'semester_mk',
            'status',
            'nilai',
          //  'tahun_akademik',
            [
                'attribute'=>'tahun_akademik',
                'header'=>'TA Kontrak',
                'headerOptions' => ['class' => 'text-center', 'style'=>"color: #337AB7"],
                'value'=>'tahun_akademik',
            ], 
            //'semester',       
            [
                //'attribute'=>'semester',
                'header'=>'SMT Kontrak',
                'headerOptions' => ['class' => 'text-center', 'style'=>"color: #337AB7"],
                'value'=>function ($data) {
                    return $data->semester; 
                    },
            ],            
        ],
    ]); ?>  
      
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'total_sks',
            [
                'label'=>'Total SKS',
                'value' => $model->getJumlahSKSHistoriDiulangBelumLulus($model->mahasiswa_npm),
                'format'=>'raw',
            ],
        ],
    ]) ?> 
</div>
