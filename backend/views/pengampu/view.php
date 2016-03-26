<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Pengampu */

$this->title = 'PENGAMPU MATAKULIAH';
$this->params['breadcrumbs'][] = ['label' => 'Pengampus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengampu-view">

    <h3 style="text-align: center; font-weight: bold"><?= Html::encode($this->title) ?></h3>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'matakuliah_kode',
            'nama_mk',
            'sks',
            'semester_mk',
            'prodi_nama_jenjang',
            'dosen_nidn',
            'nama_pengampu',
        ],
    ]) ?>

</div>
