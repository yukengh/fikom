<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'My Company',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'Master', 'items'=>[
                    ['label'=> 'Matakuliah', 'url'=>['/matakuliah/index']],
                    ['label'=> 'Prodi', 'url'=>['/prodi/index']],
                    ['label'=> 'Dosen', 'url'=>['/dosen/index']],
                    ['label'=> 'Mahasiswa', 'url'=>['/mahasiswa/index']]
                ]],                     
                ['label' => 'Proces', 'items'=>[
                    ['label'=> 'Pengampu', 'url'=>['/pengampu/index']],
                    ['label'=> 'KRS', 'url'=>['/krs/index']],
                    ['label'=> 'DNS', 'url'=>['/dns/index']],
                ]], 
                ['label' => 'Processed', 'items'=>[
                    ['label'=> 'KRS', 'url'=>['/krs-processed/index']],
                    ['label'=> 'DNS', 'url'=>['/dns-processed/index']],
                ]],  
                ['label' => 'Report', 'items'=>[
                    ['label'=> 'MK Sudah Dikontrak', 'url'=>['/dns-report/index-mk-sudah-dikontrak']],
                    ['label'=> 'MK Belum Lulus', 'url'=>['/dns-report/index-mk-belum-lulus']],
                    ['label'=> 'MK Belum Dikontrak', 'url'=>['/dns-report/index-mk-belum-dikontrak']],
                    ['label'=> 'Histori MK Diulang (Tidak Lulus)', 'url'=>['/dns-report/index-histori-mk-diulang-tidak-lulus']],
                    ['label'=> 'Prodi Matakuliah', 'url'=>['/report/index-prodi-matakuliah']],
                    ['label'=> 'Perkembangan IPS IPK', 'url'=>['/dns-report/index-perkembangan-ips-ipk']],
                    
                ]],                
                
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];                                 
            } else {
                $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
