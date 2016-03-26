<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DosenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dosens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dosen-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Dosen', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nidn',
            'nama_dosen',
            'pangkat',
            'homebase',
            'email:email',
            // 'foto',
            'sks_diampu',
            [
                'attribute'=>'foto',
                'filter'=>false,
                'format' => ['image',['width'=>'40']],
            ],          
            
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
