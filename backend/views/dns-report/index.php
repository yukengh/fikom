<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\KrsdnsReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'REPORT SUMMARIES';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="krsdns-index">

    <h3 style="text-align: center; font-weight: bold"><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => FALSE,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'tahun_akademik',
            //'semester',
            'mahasiswa_npm',
            'nama_mhs',
            'prodi_nama_jenjang',
            'dosen_wali',
            // 'total_sks',
            // 'ips',
            // 'ipk',
            // 'sks_berikutnya',

            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{delete}',
                'contentOptions' => ['style' => 'width:80px;  min-width:60px;  '],
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('MK Sudah Dikontrak', $url, [
                            'title' => Yii::t('app', 'Hapus'),
                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ]);
                    }                    
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    $idKrsDetail = $model->id;
                    if ($action === 'delete') {                       
                        return Url::to(['krs-detail/delete', 'id' => $idKrsDetail]);
                    }
                }                
            ],
            
        ],
    ]); ?>

</div>
