<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Dosen */

$this->title = 'DAFTAR DOSEN';
$this->params['breadcrumbs'][] = ['label' => 'Dosens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dosen-view">

    <h3 style="text-align: center; font-weight: bold"><?= Html::encode($this->title) ?></h3>

    <p>
        <?php // Html::a('Update', ['update', 'id' => $model->nidn], ['class' => 'btn btn-primary']) ?>
        <?php /* Html::a('Delete', ['delete', 'id' => $model->nidn], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */ ?>
    </p>
    
    <div class="col-xs-4 col-sm-3 col-lg-2">
        <?= DetailView::widget([
            'model' => $model,
            'template'=>'<tr style="text-align: center"><td>{value}</td></tr>',
            'attributes' => [
                //'foto',
                [
                    'attribute'=>'foto',
                    'format' => ['image',['height'=>'170']],
                ],

            ],
        ]) ?>
    </div>
    
    <div class="col-sm-9">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'nidn',
                'nama_dosen',
                'pangkat',
                'homebase',
                'email:email',
                //'foto',
            ],
        ]) ?>            
    </div>
    
    <h3 style="text-align: center; font-weight: bold">Matakuliah yang diampu : </h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'summary' => '',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'matakuliah_kode',
            'nama_mk',
            'sks',
            'prodi_nama_jenjang',
            'semester_mk',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>   
    
    <div>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'label'=>'Jumlah SKS yang diampu : ',
                    'value' => $model->sks_diampu,
                    'format'=>'raw',
                ]
                
            ],
        ]) ?>            
    </div>    
</div>
