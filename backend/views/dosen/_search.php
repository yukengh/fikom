<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DosenSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dosen-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'nidn') ?>

    <?= $form->field($model, 'nama_dosen') ?>

    <?= $form->field($model, 'pangkat') ?>

    <?= $form->field($model, 'homebase') ?>

    <?= $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'foto') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
