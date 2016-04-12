<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Krsdns */

$this->title = 'DAFTAR PERKEMBANGAN IPS DAN IPK MAHASISWA';
$this->params['breadcrumbs'][] = ['label' => 'PERKEMBANGAN IPS IPK', 'url' => ['index-perkembangan-ips-ipk']];
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
            'tahun_akademik',
            'semester',
            'total_sks',
            'sks_lulus',
            'ips',
            'ipk',
        ],
    ]); ?>  
      
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'total_sks',
            [
                'label'=>'Total SKS',
                'value' => $model->getJumlahSKS($model->mahasiswa_npm),
                'format'=>'raw',
            ],
        ],
    ]) ?> 
</div>
