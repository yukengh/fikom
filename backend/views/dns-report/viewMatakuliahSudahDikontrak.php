<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Krsdns */

$this->title = 'DAFTAR NILAI SELURU MATAKULIAH YANG SUDAH DIKONTRAK';
$this->params['breadcrumbs'][] = ['label' => 'MK SUDAH DIKONTRAK', 'url' => ['index']];
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
        //'filterModel' => $searchModel,
        'summary' => '',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'matakuliah_kode',
            'nama_mk',
            'sks',            
            'semester_mk',
            'nilai',
        ],
    ]); ?>  
      
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'total_sks',
            [
                'label'=>'total_sks',
                'value' => $model->getJumlahSKS($model->mahasiswa_npm),
                'format'=>'raw',
            ],
        ],
    ]) ?> 
</div>
