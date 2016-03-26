<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\select2\Select2;
use \yii\helpers\ArrayHelper;
use common\models\Matakuliah;

/* @var $this yii\web\View */
/* @var $model common\models\Krsdns */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="krsdns-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'tahun_akademik')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'semester_krs')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'semester_krs')->dropDownList([
        'I'=>'I',
        'II'=>'II',
        'III'=>'III',
        'IV'=>'IV',
        'V'=>'V',
        'VI'=>'VI',
        'VII'=>'VII',
        'VIII'=>'VIII',
        ],['prompt'=>'-- Semester --']) ?>   
    

    <?php // $form->field($model, 'mahasiswa_id')->textInput() ?>
    
    <?= $form->field($model, 'mahasiswa_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(common\models\Mahasiswa::find()->all(), 'id', 'npm'),
        'language' => 'en',
        'options' => [
            'placeholder' => '-- Mahasiswa --',
            'onchange'=>'$.post("index.php?r=krs/data-mahasiswa&id='.'"+$(this).val(),'
                . 'function(data) {'
                    . 'info = data.split("*");'
                    . '$("#krsdns-nama_mhs").val(info[1]);'
                    . '$("#krsdns-prodi").val(info[2]);'
                    . '$("#krsdns-dosen_wali").val(info[3]);'
                . '}'
            . ');'                                        
        ],
        'pluginOptions' => [
            'allowClear' => FALSE,
        ],
    ]); ?>
    
    <?= $form->field($model, 'nama_mhs')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'prodi')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'dosen_wali')->textInput(['maxlength' => true]) ?>

    <div class="row">
    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Krs Detail</h4></div>
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
                    //'krs_id',
                    'matakuliah_id',
                    'status_krsdns_mk',
                    //'nilai_mk',
                    //'nilai_bobot',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsKrsDetail as $i => $modelKrsDetail): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Krs Detail</h3>
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
                                echo Html::activeHiddenInput($modelKrsDetail, "[{$i}]krs_id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-2">
                                <?php // $form->field($modelKrsDetail, "[{$i}]matakuliah_id")->textInput(['maxlength' => true]) ?>
                                <?= $form->field($modelKrsDetail, "[{$i}]matakuliah_id")->dropDownList(
                                        ArrayHelper::map(Matakuliah::find()->all(), 'id', 'kode_mk'),[
                                            'prompt' => 'Pilih Kode Dokter',                          
                                            'onchange'=>'$.post("index.php?r=krs/data-matakuliah&id='.'"+$(this).val(),'
                                                . 'function(data) {'
                                                    . 'idx = id.split("-");'
                                                    . 'info = data.split("-");'
                                                    . '$("#krsdnsdetail-"+ idx[1] +"-nama_mk").val(info[1]);'
                                                    . '$("#krsdnsdetail-"+ idx[1] +"-sks").val(info[2]);'
                                                    . '$("#krsdnsdetail-"+ idx[1] +"-smt").val(info[3]);'
                                                    . '$("#krsdnsdetail-"+ idx[1] +"-nama_dosen").val(info[4]);'                                            
                                                . '}'
                                            . ');' 
                                            .'$.post("index.php?r=krs/status-mk-krs&mhs_id='.'"+$("select2-krsdns-mahasiswa_id-container").val()+"&mk_id='.'"+$(this).val(),'
                                                . 'function(data) {'
                                                    . 'idx = id.split("-");'
                                                    . '$("#krsdnsdetail-"+ idx[1] +"-status_krsdns_mk").val(data[0]);'
                                                . '}'
                                            . ');'                                                                                       
                                        ])->label() ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelKrsDetail, "[$i]nama_mk")->textInput(['maxlength' => true]) ?>
                            </div >
                            <div class="col-sm-1">
                                <?= $form->field($modelKrsDetail, "[{$i}]sks")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-1">
                                <?= $form->field($modelKrsDetail, "[{$i}]smt")->textInput(['maxlength' => true]) ?>
                            </div>                            
                            
                            <div class="col-sm-1">
                                <?= $form->field($modelKrsDetail, "[{$i}]status_krsdns_mk")->textInput(['maxlength' => true]) ?>
                            </div>  
                            <div class="col-sm-3">
                                <?= $form->field($modelKrsDetail, "[{$i}]nama_dosen")->textInput(['maxlength' => true]) ?>
                            </div>                                               
                        </div><!-- .row -->
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
        
    </div>    
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
