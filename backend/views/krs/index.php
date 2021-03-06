<?php

use yii\helpers\Html;
//1use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\KrsdnsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'KARTU RENCANA STUDI MAHASISWA (KRSM)';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="krsdns-index">

    <h3 style="text-align: center; font-weight: bold"><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Krsdns', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export'=>false,
        'columns' => [
            [
                'class'=>'kartik\grid\ExpandRowColumn',
                'value'=> function ($model, $key, $index, $column){
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function ($model,$key,$index,$column){
                    $searchModel = new \common\models\KrsdnsDetailSearch();
                    $searchModel->krsdns_id = $model->id;
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 
                    return Yii::$app->controller->renderPartial('_krsdetail',[
                            'searchModel' => $searchModel,
                            'dataProvider'=> $dataProvider,
                        ]);
                },
            ],

          //  'id',
            'tahun_akademik',
            'semester',
            'mahasiswa_npm',
            'nama_mhs',
            'prodi_nama_jenjang',
            // 'jenjang',
            'dosen_wali',
            // 'total_sks',
            // 'ips',
            // 'ipk',
            // 'sks_berikutnya',

            ['class' => 'yii\grid\ActionColumn'],
     /*       [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{view}{update}{delete}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                           // 'title' => Yii::t('app', 'Hapus'),
                           // 'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ]);
                    }                    
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    $idKrsDetail = $model->id;
                    if ($action === 'update') {                       
                        return Url::to(['krs/update', 'id' => $idKrsDetail]);
                    }
                }                
            ],
        */                
        ],
    ]); ?>

</div>
