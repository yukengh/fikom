<?php

namespace backend\controllers;

use Yii;
use common\models\Dosen;
use common\models\DosenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * DosenController implements the CRUD actions for Dosen model.
 */
class DosenController extends Controller
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
     * Lists all Dosen models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DosenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Dosen model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $searchModel = new \common\models\PengampuSearch();
        $dataProvider = $searchModel->search_for_dosen(Yii::$app->request->queryParams, $id);
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,            
        ]);

    }

    /**
     * Creates a new Dosen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Dosen();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            // get the instance of the uploaded file
            $imageName = $model->nidn;
            $model->file = \yii\web\UploadedFile::getInstance($model, 'file');
            
            if (!empty($model->file)) {
                // save foto in web folder
                $model->file->saveAs('uploads/foto/'. $imageName. '.'. $model->file->extension );

                // save foto path in database
                $model->foto = 'uploads/foto/'. $imageName. '.'. $model->file->extension;
            }
            $model->save(FALSE);
            return $this->redirect(['view', 'id' => $model->nidn]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }

    }

    /**
     * Updates an existing Dosen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            // get the instance of the uploaded file
            $imageName = $model->nidn;
            $model->file = \yii\web\UploadedFile::getInstance($model, 'file');
            
            if (!empty($model->file)) {
                // save foto in web folder
                $model->file->saveAs('uploads/foto/'. $imageName. '.'. $model->file->extension );

                // save foto path in database
                $model->foto = 'uploads/foto/'. $imageName. '.'. $model->file->extension;
            }
            $model->save(FALSE);
            return $this->redirect(['view', 'id' => $model->nidn]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }

    }

    /**
     * Deletes an existing Dosen model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Dosen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Dosen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dosen::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionGetDosens($nidn) {
        //find the kode_prodi from the prodi table
        $dosen = Dosen::find()->where(['nidn'=>$nidn])->one();
        echo Json::encode($dosen);
    }
    
}
