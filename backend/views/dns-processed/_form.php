<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Krsdns */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="krsdns-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tahun_akademik')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'semester')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mahasiswa_npm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_mhs')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prodi_nama_jenjang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dosen_wali')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_sks')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ips')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ipk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sks_berikutnya')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
