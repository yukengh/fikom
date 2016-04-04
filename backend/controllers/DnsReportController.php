<?php

namespace backend\controllers;

use Yii;
use common\models\Krsdns;
use common\models\KrsdnsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\KrsdnsDetailSearch;

/**
 * DnsReportController implements the CRUD actions for Krsdns model.
 */
class DnsReportController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Krsdns models.
     * @return mixed
     */
    public function actionIndexMkSudahDikontrak()
    {
        $searchModel = new KrsdnsSearch();
        $dataProvider = $searchModel->searchMkSudahDikontrak(Yii::$app->request->queryParams);

        return $this->render('index_mk_sudah_dikontrak', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionIndexPerkembanganIpsIpk()
    {
        $searchModel = new KrsdnsSearch();
        $dataProvider = $searchModel->searchPerkembanganIpsIpk(Yii::$app->request->queryParams);

        return $this->render('index_perkembangan_ips_ipk', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }    
    
    public function actionIndexMkBelumLulus()
    {
        $searchModel = new KrsdnsSearch();
        $dataProvider = $searchModel->searchMkBelumLulus(Yii::$app->request->queryParams);

        return $this->render('index_mk_belum_lulus', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }   
    
    public function actionIndexMkBelumDikontrak()
    {
        $searchModel = new KrsdnsSearch();
        $dataProvider = $searchModel->searchMkBelumDikontrak(Yii::$app->request->queryParams);

        return $this->render('index_mk_belum_dikontrak', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }  
    
    public function actionIndexHistoriMkDiulangTidakLulus()
    {
        $searchModel = new KrsdnsSearch();
        $dataProvider = $searchModel->searchHistoriMkDiulangTidakLulus(Yii::$app->request->queryParams);

        return $this->render('index_histori_mk_diulang_tidak_lulus', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }      

    /**
     * Finds the Krsdns model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Krsdns the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Krsdns::findOne(['mahasiswa_npm'=>$id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionViewMatakuliahSudahDikontrak($id)
    {
        $searchModel = new KrsdnsDetailSearch();
        $dataProvider = $searchModel->searchMatakuliahSudahDikontrak(Yii::$app->request->queryParams, $id);     
        
        return $this->render('view_matakuliah_sudah_dikontrak', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,  
        ]);
    }  
    
    public function actionViewPerkembanganIpsIpk($id)
    {
        $searchModel = new KrsdnsDetailSearch();
        $dataProvider = $searchModel->searchPerkembanganIpsIpk(Yii::$app->request->queryParams, $id);     
        
        return $this->render('view_perkembangan_ips_ipk', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,  
        ]);
    }      
    
    public function actionViewMatakuliahBelumLulus($id)
    {
        $searchModel = new KrsdnsDetailSearch();
        $dataProvider = $searchModel->searchMatakuliahBelumLulus(Yii::$app->request->queryParams, $id);     
        
        return $this->render('view_matakuliah_belum_lulus', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,  
        ]);
    } 
    
    public function actionViewHistoriMkDiulangTidakLulus($id)
    {
        $searchModel = new KrsdnsDetailSearch();
        $dataProvider = $searchModel->searchHistoriMkDiulangTidakLulus(Yii::$app->request->queryParams, $id);     
        
        return $this->render('view_histori_mk_diulang_tidak_lulus', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,  
        ]);
    }     
    
    public function actionViewMatakuliahBelumDikontrak($id)
    {
        $searchModel = new KrsdnsDetailSearch();
        $dataProvider = $searchModel->searchMatakuliahBelumDikontrak(Yii::$app->request->queryParams, $id);     
        
        return $this->render('view_matakuliah_belum_dikontrak', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,  
        ]);
    }      
}
