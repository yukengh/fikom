<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Matakuliah;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\KrsdnsDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="krsdns-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // $form->field($model, 'krsdns_id')->textInput() ?>

    <?php // $form->field($model, 'matakuliah_kode')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'matakuliah_kode')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Matakuliah::find()->all(), 'kode', 'kode'),
            'language' => 'en',
            'options' => ['placeholder' => '-- Kode Matakuliah --', 'id'=>'kodeId'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>   
    <?= $form->field($model, 'nama_mk')->textInput(['maxlength' => true, 'readOnly' => TRUE]) ?>

    <?= $form->field($model, 'semester_mk')->textInput(['maxlength' => true, 'readOnly' => TRUE]) ?>

    <?= $form->field($model, 'sks')->textInput(['maxlength' => true, 'readOnly' => TRUE]) ?>

    <?php // $form->field($model, 'gangen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(['B'=>'B',  'U'=>'U',],['prompt'=>'-']) ?>

    <?php // $form->field($model, 'nilai')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'nilai_bobot')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'jumlah_dns')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_pengampu')->textInput(['maxlength' => true, 'readOnly' => TRUE]) ?>
    
    <?= $form->field($model, 'hidden1')->hiddenInput(['value'=>$model->krsdns->id, 'id'=>'krsdns_id'])->label(false); ?>    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php  
$script = <<< JS

    $('#kodeId').change(function() {
        var kodeMk = $(this).val();
        $.get('index.php?r=matakuliah/get-matakuliahs', {kode : kodeMk}, function(data) {
            var data = $.parseJSON(data);
            $('#krsdnsdetail-nama_mk').attr('value', data.nama_mk);
            $('#krsdnsdetail-semester_mk').attr('value', data.semester_mk);
            $('#krsdnsdetail-sks').attr('value', data.sks);
        });
        $.get('index.php?r=pengampu/get-pengampu2', {kode : $(this).val(), krsdns_id : $('#krsdns_id').val()}, function(data) {
            try {
                var data = $.parseJSON(data);
                $('#krsdnsdetail-nama_pengampu').attr('value', data.nama_pengampu);
            } catch (err) {
                $('#krsdnsdetail-nama_pengampu').attr('value', '');
            }
        });          
    });

JS;
$this->registerJs($script); 
?>

