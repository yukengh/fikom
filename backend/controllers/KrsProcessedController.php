<?php

namespace backend\controllers;

use Yii;
use common\models\Krsdns;
use common\models\KrsdnsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\KrsdnsDetail;
use common\models\Model;
use yii\helpers\ArrayHelper;
use common\models\KrsdnsDetailSearch;

/**
 * KrsController implements the CRUD actions for Krsdns model.
 */
class KrsProcessedController extends Controller
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
    public function actionIndex()
    {
        $searchModel = new KrsdnsSearch();
        $dataProvider = $searchModel->searchProcessed(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }    

    /**
     * Displays a single Krsdns model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $searchModel = new KrsdnsDetailSearch();
        $dataProvider = $searchModel->search2(Yii::$app->request->queryParams, $id);
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,            
        ]);
    }   

    /**
     * Creates a new Krsdns model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Krsdns();
        $modelsKrsDetail = [new KrsdnsDetail];   
        
        if ($model->load(Yii::$app->request->post())) {           
            $modelsKrsDetail = Model::createMultiple(KrsdnsDetail::classname());
            Model::loadMultiple($modelsKrsDetail, Yii::$app->request->post());
            // validate all models
            $valid1 = $model->validate();
            $valid = Model::validateMultiple($modelsKrsDetail) && $valid1;            

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsKrsDetail as $modelKrsDetail) {
                            $modelKrsDetail->krsdns_id = $model->id;
                            if (! ($flag = $modelKrsDetail->save())) {
                                $transaction->rollBack();
                               // break;

                                return $this->render('create', [
                                    'model' => $model,
                                    'modelsKrsDetail' => (empty($modelsKrsDetail)) ? [new KrsdnsDetail] : $modelsKrsDetail
                                ]);                                 
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                   
                    $transaction->rollBack();
                    return $this->render('create', [
                        'model' => $model,
                        'modelsKrsDetail' => (empty($modelsKrsDetail)) ? [new KrsdnsDetail] : $modelsKrsDetail
                    ]);                     
                }
            } else {              
                return $this->render('create', [
                    'model' => $model,
                    'modelsKrsDetail' => (empty($modelsKrsDetail)) ? [new KrsdnsDetail] : $modelsKrsDetail
                ]);                 
            }            
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelsKrsDetail' => (empty($modelsKrsDetail)) ? [new KrsdnsDetail] : $modelsKrsDetail
            ]);
        }
    }


    /**
     * Updates an existing Krsdns model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelsKrsDetail = $model->krsdnsDetails;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            $oldIDs = ArrayHelper::map($modelsKrsDetail, 'id', 'id');
            $modelsKrsDetail1 = Model::createMultiple(KrsdnsDetail::classname(), $modelsKrsDetail);
            Model::loadMultiple($modelsKrsDetail, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsKrsDetail1, 'id', 'id')));            
            
            // validate all models
            $valid1 = $model->validate();
            $valid = Model::validateMultiple($modelsKrsDetail) && $valid1;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if (! empty($deletedIDs)) {
                        KrsdnsDetail::deleteAll(['id' => $deletedIDs]);
                    }                    
                    if ($flag = $model->save(false)) {
                        foreach ($modelsKrsDetail as $modelKrsDetail) {
                            $modelKrsDetail->krsdns_id = $model->id;
                            if (! ($flag = $modelKrsDetail->save())) {                              
                                $transaction->rollBack();
                               // break;
                                return $this->render('update', [
                                    'model' => $model,
                                    'modelsKrsDetail' => (empty($modelsKrsDetail)) ? [new KrsdnsDetail] : $modelsKrsDetail
                                ]);                                
                            }
                        }
                    }                 
                   
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }  
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelsKrsDetail' => (empty($modelsKrsDetail)) ? [new KrsdnsDetail] : $modelsKrsDetail
            ]);
        }
    }

    /**
     * Deletes an existing Krsdns model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
        if (($model = Krsdns::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
     * Mencari status matakuliah berdasarkan kode matakuliah dan npm mahasiswa.
     * krs: _form.php, _form_update.php
     * @param type $kode_mk
     * @param type $npm
     * @return string B atau U
     */
    public function actionGetStatusMatakuliah($kode_mk, $npm) {
        $status = 'B';
        
        $krsdnsDetail = KrsdnsDetail::find()
                ->select('krsdns_detail.nama_mk')
                ->joinWith('krsdns')
                ->where('krsdns_detail.matakuliah_kode = :kode_mk', [':kode_mk' => $kode_mk])
                ->andwhere('krsdns.mahasiswa_npm = :npm', [':npm' => $npm])
                ->one();
        
        if ($krsdnsDetail) {
            $status = 'U';
        }
        
        return $status;
    }    
    
    /**
     * Mencari status matakuliah berdasarkan kode matakuliah dan krsdns_id pada tabel krsdns_detail
     * krs-detail: _form.php
     * @param type $kode_mk
     * @param type $krsdns_id
     * @return string
     */
    public function actionGetStatusMatakuliah2($kode_mk, $krsdns_id) {
        $status = 'B';
        
        $krsdns = Krsdns::find()
                ->select('mahasiswa_npm')
                ->where('id = :krsdns_id', [':krsdns_id' => $krsdns_id])
                ->one();
        
        $krsdnsDetail = KrsdnsDetail::find()
                ->select('krsdns_detail.nama_mk')
                ->joinWith('krsdns')
                ->where('krsdns_detail.matakuliah_kode = :kode_mk', [':kode_mk' => $kode_mk])
                ->andwhere('krsdns.mahasiswa_npm = :npm', [':npm' => $krsdns->mahasiswa_npm])
                ->one();
        
        if ($krsdnsDetail) {
            $status = 'U';
        }
        
        return $status;
    }     
}
