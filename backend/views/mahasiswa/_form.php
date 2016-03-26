<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use common\models\Prodi;
use yii\helpers\ArrayHelper;
use common\models\Dosen;
use yii\bootstrap\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Mahasiswa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mahasiswa-form">
    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
        'layout' => 'horizontal',
        ]); ?>

    <?= $form->field($model, 'npm')->textInput(['maxlength' => 9]) ?>

    <?= $form->field($model, 'nama_mhs', ['options' => ['class' => 'form-group inline']])->textInput(['maxlength' => 65]) ?>

    <?= $form->field($model, 'tpt_lahir_mhs')->textInput(['maxlength' => 45]) ?>

    <?php // $form->field($model, 'tgl_lahir_mhs')->textInput() ?>
    <?= $form->field($model, 'tgl_lahir_mhs')->widget(
           DatePicker::className(), [
                'inline' => FALSE,
                'language' => 'id',
             //   'size' => 'lg',      
                'options' => ['placeholder' => '-- Tanggal Lahir --'],
               //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
               'clientOptions' => [
                   'autoclose' => true,
                   'format' => 'dd MM yyyy',
               ]
       ]);?>

    <?php // $form->field($model, 'jk_mhs')->textInput(['maxlength' => 12]) ?>
    <?= $form->field($model, 'jk_mhs')->dropDownList(['Laki-laki'=>'Laki-laki',  'Perempuan'=>'Perempuan'],['prompt'=>'-- Jenis Kelamin --']) ?>    

    <?php // $form->field($model, 'agama_mhs')->textInput(['maxlength' => 20]) ?>
    <?= $form->field($model, 'agama_mhs')->dropDownList([
        'Islam'=>'Islam',
        'Kristen Protestan'=>'Kristen Protestan',
        'Katolik'=>'Katolik',
        'Hindu'=>'Hindu',
        'Buddha'=>'Buddha',
        'Kong Hu Cu'=>'Kong Hu CU',
        ],['prompt'=>'-- Agama --']
    )?>   
    

    <?= $form->field($model, 'suku')->textInput(['maxlength' => 15]) ?>

    <?php // $form->field($model, 'prodi_jenjang')->textInput(['maxlength' => 35]) ?>
    <?= $form->field($model, 'prodi_jenjang')->dropDownList(
            ArrayHelper::map(Prodi::find()->all(), 'nama_jenjang', 'nama_jenjang'),
            ['prompt' => '-- Program Studi --']            
            ) ?>
    

    <?= $form->field($model, 'alamat_mhs')->textInput(['maxlength' => 145]) ?>

    <?= $form->field($model, 'phone_mhs')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'email_mhs')->textInput(['maxlength' => 25]) ?>

    <?= $form->field($model, 'asal_slta')->textInput(['maxlength' => 25]) ?>

    <?= $form->field($model, 'jurusan_slta')->textInput(['maxlength' => 15]) ?>

    <?php // $form->field($model, 'status_masuk')->textInput(['maxlength' => 15]) ?>
    <?= $form->field($model, 'status_masuk')->dropDownList(['Baru'=>'Baru',  'Transfer'=>'Transfer',],['prompt'=>'-- Status Masuk USTJ --']) ?>        

    <?php // $form->field($model, 'status_kuliah')->textInput(['maxlength' => 15]) ?>
    <?= $form->field($model, 'status_kuliah')->dropDownList(['Aktif'=>'Aktif',  'Tidak Aktif'=>'Tidak Aktif',],['prompt'=>'-- Status Kuliah --']) ?>            

    <?php // $form->field($model, 'dosen_wali_nidn')->textInput(['maxlength' => 12]) ?>
    <?= $form->field($model, 'dosen_wali_nidn')->dropDownList(
            ArrayHelper::map(Dosen::find()->all(), 'nidn', 'nidn'),
            ['prompt' => '-- Dosen Wali --', 'id'=>'nidn']            
            ) ?>    

    <?= $form->field($model, 'dosen_wali_nama')->textInput(['maxlength' => 45, 'readOnly' => TRUE]) ?>

    <?= $form->field($model, 'angkatan')->textInput(['maxlength' => 5]) ?>
    
    <?php // $form->field($model, 'foto')->textInput(['maxlength' => 245]) ?>
    <?= $form->field($model, 'file')->fileInput() ?>    

    <div class="form-group" style="text-align: center">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php 
$script = <<< JS
// here you right all your javascript stuff
    $('#nidn').change(function() {
        var nidn = $(this).val();
        $.get('index.php?r=dosen/get-dosens', {nidn : nidn}, function(data) {
            var data = $.parseJSON(data);
            $('#mahasiswa-dosen_wali_nama').attr('value', data.nama_dosen);
        });
    });
JS;
$this->registerJs($script);
?>



