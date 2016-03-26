<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PengampuSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengampu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'matakuliah_kode') ?>

    <?= $form->field($model, 'nama_mk') ?>

    <?= $form->field($model, 'prodi_nama_jenjang') ?>

    <?= $form->field($model, 'dosen_nidn') ?>

    <?php // echo $form->field($model, 'nama_pengampu') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
