<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Matakuliah;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Matakuliah */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matakuliah-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode')->textInput(['maxlength' => 9]) ?>

    <?= $form->field($model, 'nama_mk')->textInput(['maxlength' => 65]) ?>

    <?= $form->field($model, 'sks')->textInput(['maxlength' => 2]) ?>

    <?php // $form->field($model, 'gangen')->textInput(['maxlength' => 6]) ?>
    <?= $form->field($model, 'semester_mk')->dropDownList(
            Matakuliah::getSemester(),
            ['prompt' => '-- Semester --', 'id'=>'smt']            
            ) ?>

    <?= $form->field($model, 'gangen')->textInput(['maxlength' => 6, 'readOnly'=>TRUE]) ?>   

    <?= $form->field($model, 'kelompok_mk')->textInput(['maxlength' => 15]) ?>

    <?php // $form->field($model, 'prasyarat')->textInput(['maxlength' => 9]) ?>
    <?= $form->field($model, 'prasyarat')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Matakuliah::find()->all(), 'kode', 'nama_mk'),
        'language' => 'en',
        'options' => ['placeholder' => '-- Prasyarat Matakuliah --'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php 
$script = <<< JS
// here you right all your javascript stuff
        
    $('#smt').change(function() {
        var smt = $(this).val();
        $.get('index.php?r=matakuliah/get-gangen', {smt : smt}, function(data) {
         $('#matakuliah-gangen').attr('value', data);
        });
    });
JS;
$this->registerJs($script);
?>

