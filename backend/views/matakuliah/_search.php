<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MatakuliahSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matakuliah-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'kode') ?>

    <?= $form->field($model, 'nama_mk') ?>

    <?= $form->field($model, 'sks') ?>

    <?= $form->field($model, 'gangen') ?>

    <?= $form->field($model, 'kelompok_mk') ?>

    <?php // echo $form->field($model, 'prasyarat') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
