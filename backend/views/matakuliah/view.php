<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Matakuliah */

$this->title = 'MATAKULIAH';
$this->params['breadcrumbs'][] = ['label' => 'Matakuliahs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matakuliah-view">

    <h3 style="text-align: center; font-weight: bold"><?= Html::encode($this->title) ?></h3>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kode',
            'nama_mk',
            'sks',
            'gangen',
            [
                'label'=>'prasyarat',
                'value' => $model->prasyarat ? $model->prasyarat0->nama_mk : ' ',
                'format'=>'raw',
            ],
            'kelompok_mk',
        ],
    ]) ?>

</div>
