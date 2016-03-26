<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\KrsdnsDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Krsdns Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="krsdns-detail-index">

    <h1><?php // Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => FALSE,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],        
            //'krsdns_id',
            'matakuliah_kode',
            'nama_mk',
            'sks',
            'semester_mk',
            //'gangen',
            'status',
            // 'pengampu_id',
            // 'nilai',
            // 'nilai_bobot',
            // 'jumlah_dns',
            'nama_pengampu',

            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{delete}',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-minus"></span>', $url, [
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
    <p style="text-align: center;">
        <?= Html::a('Tambah Matakuliah', ['krs-detail/create', 'id'=>$searchModel->krsdns_id], [
            'class' => 'btn btn-success']); 
        ?>
    </p>   
</div>
