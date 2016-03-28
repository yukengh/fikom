<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\KrsdnsDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Krsdns Details';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="krsdns-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Krsdns Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'krsdns_id',
            'matakuliah_kode',
            'nama_mk',
            'semester_mk',
            // 'sks',
            // 'gangen',
            // 'status',
            // 'nilai',
            // 'nilai_bobot',
            // 'jumlah_dns',
            // 'nama_pengampu',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
