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
            'nama_pengampu',
            'nilai',
            'nilai_bobot',
            'jumlah_dns',                        
        ],
    ]); ?> 
</div>
