<?php

namespace backend\controllers;

use Yii;
use common\models\KrsdnsDetail;
use common\models\KrsdnsDetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Krsdns;

/**
 * KrsDetailController implements the CRUD actions for KrsdnsDetail model.
 */
class KrsDetailController extends Controller
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
     * Lists all KrsdnsDetail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KrsdnsDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single KrsdnsDetail model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new KrsdnsDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {  
       $model = new KrsdnsDetail();
       $model->krsdns_id = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['krs/index']);
            return $this->redirect(['krs/view', 'id' => $model->krsdns_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);

        }
    } 

    /**
     * Updates an existing KrsdnsDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing KrsdnsDetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        // dapatkan krsdns_id dan sks dari tabel krsdns_detail berdasarkan id nya
        $krsdnsDetail = KrsdnsDetail::findOne($id);
        $krsdns_id = $krsdnsDetail->krsdns_id;
        $sks = $krsdnsDetail->sks;     
        
        // dapatkan jumlah(sks) dari tabel krsdns_detail berdasarkan krsdns_id nya
        $total_sks = KrsdnsDetail::find()
                ->where(['krsdns_id'=>$krsdns_id])
                ->sum('sks');
        
        // kurangi total_sks yang ada dengan jumlah sks yg akan dihapus
        $new_total_sks = $total_sks - $sks;
        
        //ubah total_sks pada tabel krsdns berdasarkan id = krsdns_detail.krsdns_id
        $krsdns = Krsdns::findOne($krsdns_id);
        $krsdns->total_sks = $new_total_sks;    
        if ($krsdns->save(FALSE)) {
            // hapus tabel krdns_detail
            $this->findModel($id)->delete();
            //return $this->redirect(['krs/index']);
            return $this->redirect(['krs/view', 'id' => $krsdns_id]);
        } else {
            print_r('Error Update total_sks');
            die();
        }
    }

    /**
     * Finds the KrsdnsDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KrsdnsDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KrsdnsDetail::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
