<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use common\models\KrsdnsDetail;

/* @var $this yii\web\View */
/* @var $model common\models\Krsdns */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="krsdns-form">
    
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
        <?= $form->field($model, 'tahun_akademik')->textInput(['maxlength' => true, 'readonly' => true]) ?>
        <?= $form->field($model, 'semester')->textInput(['maxlength' => true, 'readonly' => true]) ?>
        <?= $form->field($model, 'mahasiswa_npm')->textInput(['maxlength' => true, 'readonly' => true]) ?>
        <?= $form->field($model, 'nama_mhs')->textInput(['maxlength' => true, 'readonly' => true]) ?>
        <?= $form->field($model, 'prodi_nama_jenjang')->textInput(['maxlength' => true, 'readonly' => true]) ?>
        <?= $form->field($model, 'dosen_wali')->textInput(['maxlength' => true, 'readonly' => true]) ?>
        <?php // $form->field($model, 'total_sks')->textInput(['maxlength' => true]) ?>
        
    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> DNS Detail</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 7, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsDnsDetail[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'krsdns_id',
                    'matakuliah_kode',
                    'nama_mk',
                    'sks',                    
                    'semester_mk',
                    //'gangen',
                    'status',
                    'nama_pengampu',                    
                    //'pengampu_id',
                    'nilai',
                    'nilai_bobot',
                    'jumlah_dns',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsDnsDetail as $i => $modelKrsDetail): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelKrsDetail->isNewRecord) {
                                echo Html::activeHiddenInput($modelKrsDetail, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-1">
                                <?= $form->field($modelKrsDetail, "[{$i}]matakuliah_kode")->textInput(['maxlength' => true, 'readonly' => true]) ?>
                            </div> 
                            <div class="col-sm-3">
                                <?= $form->field($modelKrsDetail, "[{$i}]nama_mk")->textInput(['maxlength' => true, 'readonly' => true]) ?>
                            </div>
                            <div class="col-sm-1">
                                <?= $form->field($modelKrsDetail, "[{$i}]sks")->textInput(['maxlength' => true, 'readonly' => true]) ?>
                            </div>                            
                            <div class="col-sm-1">
                                <?= $form->field($modelKrsDetail, "[{$i}]semester_mk")->textInput(['maxlength' => true, 'readonly' => true]) ?>
                            </div>
                            <div class="col-sm-1">
                                <?= $form->field($modelKrsDetail, "[{$i}]status")->textInput(['maxlength' => true, 'readonly' => true]) ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($modelKrsDetail, "[{$i}]nama_pengampu")->textInput(['maxlength' => true, 'readonly' => true]) ?>
                            </div>
                            <div class="col-sm-1">
                                <?= $form->field($modelKrsDetail, "[{$i}]nilai")->dropDownList(KrsdnsDetail::getNilai(),[
                                    'prompt' => '--',                          
                                    'onchange'=>'idx = id.split("-");'
                                        . '$.get("index.php?r=dns-detail/get-hitungan-dns-detail", {nilai : $(this).val(), '
                                                . 'sks : $("#krsdnsdetail-"+ idx[1] +"-sks").val()}, function(data) {'
                                            . 'info = data.split("#");'
                                            . '$("#krsdnsdetail-"+ idx[1] +"-nilai_bobot").val(info[0]);'
                                            . '$("#krsdnsdetail-"+ idx[1] +"-jumlah_dns").val(info[1]);'
                                        . '});'                                                                                       
                                ])->label() ?>
                            </div>                                 
                            <div class="col-sm-1">
                                <?= $form->field($modelKrsDetail, "[{$i}]nilai_bobot")->textInput(['maxlength' => true, 'readonly' => true])->label('NB') ?>
                            </div> 
                            <div class="col-sm-1">
                                <?= $form->field($modelKrsDetail, "[{$i}]jumlah_dns")->textInput(['maxlength' => true, 'readonly' => true])->label('Jumlah') ?>
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
