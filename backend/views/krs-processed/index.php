<?php

use yii\helpers\Html;
//1use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\KrsdnsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'KARTU RENCANA STUDI MAHASISWA (KRSM)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="krsdns-index">

    <h3 style="text-align: center; font-weight: bold"><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // Html::a('Create Krsdns', ['create'], ['class' => 'btn btn-success']) ?>
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

           // ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => "{view}{delete}",
            ],
                        
        ],
    ]); ?>

</div>
