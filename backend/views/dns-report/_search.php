<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\KrsdnsReportSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="krsdns-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tahun_akademik') ?>

    <?= $form->field($model, 'semester') ?>

    <?= $form->field($model, 'mahasiswa_npm') ?>

    <?= $form->field($model, 'nama_mhs') ?>

    <?php // echo $form->field($model, 'prodi_nama_jenjang') ?>

    <?php // echo $form->field($model, 'dosen_wali') ?>

    <?php // echo $form->field($model, 'total_sks') ?>

    <?php // echo $form->field($model, 'ips') ?>

    <?php // echo $form->field($model, 'ipk') ?>

    <?php // echo $form->field($model, 'sks_berikutnya') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
