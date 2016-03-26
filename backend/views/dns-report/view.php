<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Krsdns */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Krsdns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="krsdns-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tahun_akademik',
            'semester',
            'mahasiswa_npm',
            'nama_mhs',
            'prodi_nama_jenjang',
            'dosen_wali',
            'total_sks',
            'ips',
            'ipk',
            'sks_berikutnya',
        ],
    ]) ?>

</div>
