<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MahasiswaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mahasiswa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'npm') ?>

    <?= $form->field($model, 'nama_mhs') ?>

    <?= $form->field($model, 'tpt_lahir_mhs') ?>

    <?= $form->field($model, 'tgl_lahir_mhs') ?>

    <?= $form->field($model, 'jk_mhs') ?>

    <?php // echo $form->field($model, 'agama_mhs') ?>

    <?php // echo $form->field($model, 'suku') ?>

    <?php // echo $form->field($model, 'prodi_jenjang') ?>

    <?php // echo $form->field($model, 'alamat_mhs') ?>

    <?php // echo $form->field($model, 'phone_mhs') ?>

    <?php // echo $form->field($model, 'email_mhs') ?>

    <?php // echo $form->field($model, 'asal_slta') ?>

    <?php // echo $form->field($model, 'jurusan_slta') ?>

    <?php // echo $form->field($model, 'status_masuk') ?>

    <?php // echo $form->field($model, 'status_kuliah') ?>

    <?php // echo $form->field($model, 'dosen_wali_nidn') ?>

    <?php // echo $form->field($model, 'dosen_wali_nama') ?>

    <?php // echo $form->field($model, 'foto') ?>

    <?php // echo $form->field($model, 'angkatan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
