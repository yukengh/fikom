<?php

namespace backend\controllers;

use Yii;
use common\models\Pengampu;
use common\models\PengampuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use \common\models\Dosen;

/**
 * PengampuController implements the CRUD actions for Pengampu model.
 */
class PengampuController extends Controller
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
     * Lists all Pengampu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PengampuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pengampu model.
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
     * Creates a new Pengampu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pengampu();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pengampu model.
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
     * Deletes an existing Pengampu model.
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
     * Finds the Pengampu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pengampu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pengampu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionGetPengampu($kode, $prodi) {
        //find the kode_prodi from the prodi table
        $pengampu = Pengampu::find()
                ->where('matakuliah_kode = :kode', [':kode' => $kode])
                ->andwhere('prodi_nama_jenjang = :prodi', [':prodi' => $prodi])
                ->one();
        echo Json::encode($pengampu);
    }    
 /*   
    public function actionGetPengampu2($kode, $krsdns_id) {
        $pengampu = Pengampu::find()
                ->select('pengampu.nama_pengampu')
                ->joinWith(['krsdns', 'krsdnsDetail'])
                ->andwhere(['pengampu.matakuliah_kode'=>$kode, 'krsdns.id'=>$krsdns_id])->one();
                
        echo Json::encode($pengampu);
    }
   */ 
    public function actionLists($id) {  
        // dapatkan prodi mahasiswa berdasarkan npm nya
        $prodi = \common\models\Mahasiswa::find()
                ->select('prodi_jenjang')
                ->where('npm = :npm', [':npm' => $id])
                ->one();
        
        $count = Pengampu::find()
                ->select('matakuliah_kode')
                ->where('prodi_nama_jenjang = :prodi', [':prodi' => $prodi->prodi_jenjang])
                ->count();
        
        $datas = Pengampu::find()
                ->select('matakuliah_kode')
                ->where('prodi_nama_jenjang = :prodi', [':prodi' => $prodi->prodi_jenjang])
                ->all();     
        
        if ($count > 0) {
            echo '<option>-- Kode Matakuliah --</option>';
            foreach ($datas as $data) {
                echo "<option value='".$data->matakuliah_kode."'>".$data->matakuliah_kode. "</option>";
            }
        } else {
            echo '<option> - </option>';
        }   
    }
    
}
