<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\KrsdnsDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="krsdns-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'krsdns_id')->textInput() ?>

    <?= $form->field($model, 'matakuliah_kode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_mk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'semester_mk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sks')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gangen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nilai')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nilai_bobot')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jumlah_dns')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_pengampu')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
