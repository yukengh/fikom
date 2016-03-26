<?php

namespace backend\controllers;

use Yii;
use common\models\Krsdns;
use common\models\KrsdnsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use common\models\Model;
use common\models\KrsdnsDetail;
use common\models\KrsdnsDetailSearch;

/**
 * DnsController implements the CRUD actions for Krsdns model.
 */
class DnsController extends Controller
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
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
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
        $modelsDnsDetail = $model->krsdnsDetails;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            $oldIDs = ArrayHelper::map($modelsDnsDetail, 'id', 'id');
            $modelsDnsDetail1 = Model::createMultiple(KrsdnsDetail::classname(), $modelsDnsDetail);
            Model::loadMultiple($modelsDnsDetail, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsDnsDetail1, 'id', 'id')));            
            
            // validate all models
            $valid1 = $model->validate();
            $valid = Model::validateMultiple($modelsDnsDetail) && $valid1;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if (! empty($deletedIDs)) {
                        KrsdnsDetail::deleteAll(['id' => $deletedIDs]);
                    }                    
                    if ($flag = $model->save(false)) {
                        foreach ($modelsDnsDetail as $modelKrsDetail) {
                            $modelKrsDetail->krsdns_id = $model->id;
                            $modelKrsDetail->scenario = 'update';
                            if (! ($flag = $modelKrsDetail->save())) {                              
                                $transaction->rollBack();
                               // break;
                                return $this->render('update', [
                                    'model' => $model,
                                    'modelsDnsDetail' => (empty($modelsDnsDetail)) ? [new KrsdnsDetail] : $modelsDnsDetail
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
                'modelsDnsDetail' => (empty($modelsDnsDetail)) ? [new KrsdnsDetail] : $modelsDnsDetail
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
}
