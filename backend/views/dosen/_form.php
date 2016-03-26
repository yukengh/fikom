<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Prodi;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Dosen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dosen-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'nidn')->textInput(['maxlength' => 12]) ?>

    <?= $form->field($model, 'nama_dosen')->textInput(['maxlength' => 65]) ?>

    <?= $form->field($model, 'pangkat')->textInput(['maxlength' => 15]) ?>

    <?php // $form->field($model, 'homebase')->textInput(['maxlength' => 35]) ?>
    <?= $form->field($model, 'homebase')->dropDownList(
            ArrayHelper::map(Prodi::find()->all(), 'nama_jenjang', 'nama_jenjang'),
            ['prompt' => '-- Homebase --']            
            ) ?>
    

    <?= $form->field($model, 'email')->textInput(['maxlength' => 25]) ?>

    <?php // $form->field($model, 'foto')->textInput(['maxlength' => 245]) ?>
    <?= $form->field($model, 'file')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
