<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */

$this->title = 'DAFTAR MATAKULIAH PER PRODI';
$this->params['breadcrumbs'][] = ['label' => 'MK PER PRODI', 'url' => ['index-prodi-matakuliah']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prodi-view">

    <h3 style="text-align: center; font-weight: bold"><?= Html::encode($this->title) ?></h3>

    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nama_jenjang',
            'kode',
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
        ],
    ]);   ?>  
      
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label'=>'Total SKS',
                'value' =>$model->getJumlahSKSProdi($model->nama_jenjang),
                'format'=>'raw',
            ],
        ],
    ]) ?> 
</div>
