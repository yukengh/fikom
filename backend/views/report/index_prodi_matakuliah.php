<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\KrsdnsReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'DAFTAR PRODI MATAKULIAH';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prodi-index">

    <h3 style="text-align: center; font-weight: bold"><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => FALSE,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nama_jenjang',
            'kode',
           // ['class' => 'yii\grid\ActionColumn'],
         [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{1}',
                'buttons' => [
                    '1' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' => Yii::t('app', 'Matakuliah yang belum Lulus'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ]);
                    }                    
                ],

                'urlCreator' => function ($action, $model, $key, $index) {
                    $id = $model->nama_jenjang;
                    switch ($action) {
                        case('1'): return Url::to(['report/view-prodi-matakuliah', 'id' => $id]); break;
                    }
                }                
            ],     
        ],
    ]); ?>

</div>
