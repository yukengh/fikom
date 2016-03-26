<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Matakuliah;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\Prodi;
use common\models\Dosen;

/* @var $this yii\web\View */
/* @var $model common\models\Pengampu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengampu-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?php // $form->field($model, 'prodi_nama_jenjang')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'prodi_nama_jenjang')->dropDownList(
            ArrayHelper::map(Prodi::find()->all(), 'nama_jenjang', 'nama_jenjang'),
            ['prompt' => '-- Program Studi --', 'empty' => ' ']            
            ) ?>    

    <?php // $form->field($model, 'matakuliah_kode')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'matakuliah_kode')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Matakuliah::find()->all(), 'kode', 'kode'),
        'language' => 'en',
        'options' => ['placeholder' => '-- Kode Matakuliah --', 'id'=>'mk_kode'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
    

    <?= $form->field($model, 'nama_mk')->textInput(['maxlength' => true, 'readOnly' => TRUE]) ?>
    <?= $form->field($model, 'sks')->textInput(['maxlength' => true, 'readOnly' => TRUE]) ?> 
    <?= $form->field($model, 'semester_mk')->textInput(['maxlength' => true, 'readOnly' => TRUE]) ?> 

    <?php // $form->field($model, 'dosen_nidn')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'dosen_nidn')->dropDownList(
            ArrayHelper::map(Dosen::find()->all(), 'nidn', 'nidn'),
            ['prompt' => '-- Dosen --', 'id' => 'dosen_nidn']            
            ) ?>    

    <?= $form->field($model, 'nama_pengampu')->textInput(['maxlength' => true, 'readOnly' => TRUE]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php 
$script = <<< JS
        
    $('#mk_kode').change(function() {
        var kode = $(this).val();
        $.get('index.php?r=matakuliah/get-matakuliahs', {kode : kode}, function(data) {
            var data = $.parseJSON(data);
            $('#pengampu-nama_mk').attr('value', data.nama_mk);
            $('#pengampu-sks').attr('value', data.sks);
            $('#pengampu-semester_mk').attr('value', data.semester_mk);
        });
    });
        
    $('#dosen_nidn').change(function() {
        var nidn = $(this).val();
        $.get('index.php?r=dosen/get-dosens', {nidn : nidn}, function(data) {
            var data = $.parseJSON(data);
            $('#pengampu-nama_pengampu').attr('value', data.nama_dosen);
        });
    });
        
JS;
$this->registerJs($script);
?>

