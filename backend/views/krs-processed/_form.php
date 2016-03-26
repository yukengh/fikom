<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use common\models\Mahasiswa;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\Matakuliah;
//use kartik\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Krsdns */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="krsdns-form">
    
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
        <?= $form->field($model, 'tahun_akademik')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'semester')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'mahasiswa_npm')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Mahasiswa::find()->all(), 'npm', 'npm'),
            'language' => 'en',
            'options' => ['placeholder' => '-- NPM Mahasiswa --', 'id'=>'npm'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
        <?= $form->field($model, 'nama_mhs')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'prodi_nama_jenjang')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'dosen_wali')->textInput(['maxlength' => true]) ?>
        <?php // $form->field($model, 'total_sks')->textInput(['maxlength' => true]) ?>
        
    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> KRS Detail</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 7, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsKrsDetail[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    //'krsdns_id',
                    'matakuliah_kode',
                    'nama_mk',
                    'semester_mk',
                    'sks',
                    //'gangen',
                    'status',
                    //'pengampu_id',
                    //'nilai',
                    //'nilai_bobot',
                    //'jumlah_dns',
                    'nama_pengampu',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsKrsDetail as $i => $modelKrsDetail): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">KRS Detail</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelKrsDetail->isNewRecord) {
                                echo Html::activeHiddenInput($modelKrsDetail, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-2">
                            <?= $form->field($modelKrsDetail, "[{$i}]matakuliah_kode")->dropDownList(
                                    ArrayHelper::map(Matakuliah::find()->all(), 'kode', 'kode'),[
                                        'prompt' => '-- Kode Matakuliah --',                          
                                        'onchange'=>'idx = id.split("-");'
                                            . '$.get("index.php?r=matakuliah/get-matakuliahs", {kode : $(this).val()}, function(data) {'
                                                . 'var data = $.parseJSON(data);'
                                                . '$("#krsdnsdetail-"+ idx[1] +"-nama_mk").val(data.nama_mk);'
                                                . '$("#krsdnsdetail-"+ idx[1] +"-semester_mk").val(data.semester_mk);'
                                                . '$("#krsdnsdetail-"+ idx[1] +"-sks").val(data.sks);'                                         
                                            . '});'  
                                            .'$.get("index.php?r=pengampu/get-pengampu", {kode : $(this).val(), prodi : $("#krsdns-prodi_nama_jenjang").val()}, function(data) {'
                                                . 'var data = $.parseJSON(data);'
                                                . '$("#krsdnsdetail-"+ idx[1] +"-nama_pengampu").val(data.nama_pengampu);'                                       
                                            . '});'                                                                                      
                                    ])->label() ?>
                            </div> 
                            <div class="col-sm-4">
                                <?= $form->field($modelKrsDetail, "[{$i}]nama_mk")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-1">
                                <?= $form->field($modelKrsDetail, "[{$i}]semester_mk")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-1">
                                <?= $form->field($modelKrsDetail, "[{$i}]sks")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-1">
                                <?php //$form->field($modelKrsDetail, "[{$i}]status")->textInput(['maxlength' => true]) ?>
                                <?= $form->field($modelKrsDetail, "[{$i}]status")->dropDownList([
                                    'B'=>'B',  'U'=>'U',],['prompt'=>'-']) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelKrsDetail, "[{$i}]nama_pengampu")->textInput(['maxlength' => true]) ?>                            
                            </div>
                        </div><!-- .row -->
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
        
    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php 
$script = <<< JS
        
    $('#npm').change(function() {
        var npm = $(this).val();
        $.get('index.php?r=mahasiswa/get-mahasiswas', {npm : npm}, function(data) {
            var data = $.parseJSON(data);
            $('#krsdns-nama_mhs').attr('value', data.nama_mhs);
            $('#krsdns-prodi_nama_jenjang').attr('value', data.prodi_jenjang);
            $('#krsdns-dosen_wali').attr('value', data.dosen_wali_nama);
        });      
    });      
        
JS;
$this->registerJs($script);
?>
