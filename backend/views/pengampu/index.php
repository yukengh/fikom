<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PengampuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengampus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengampu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pengampu', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'prodi_nama_jenjang',
            'matakuliah_kode',
            'nama_mk',
            'sks',
            'semester_mk',
            'nama_pengampu',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
