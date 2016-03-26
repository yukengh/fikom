<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\KrsdnsDetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="krsdns-detail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'krsdns_id') ?>

    <?= $form->field($model, 'matakuliah_kode') ?>

    <?= $form->field($model, 'nama_mk') ?>

    <?= $form->field($model, 'semester_mk') ?>

    <?php // echo $form->field($model, 'sks') ?>

    <?php // echo $form->field($model, 'gangen') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'nilai') ?>

    <?php // echo $form->field($model, 'nilai_bobot') ?>

    <?php // echo $form->field($model, 'jumlah_dns') ?>

    <?php // echo $form->field($model, 'nama_pengampu') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
