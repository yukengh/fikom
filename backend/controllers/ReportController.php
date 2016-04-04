<?php

namespace backend\controllers;

use Yii;
use common\models\Krsdns;
use yii\web\NotFoundHttpException;

class ReportController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    /**
     * Finds the Krsdns model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Krsdns the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelPengampu($id)
    {
        if (($model = \common\models\Prodi::findOne(['nama_jenjang'=>$id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }    

    public function actionIndexProdiMatakuliah()
    {
        $searchModel = new \common\models\ProdiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index_prodi_matakuliah', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }     
    
    public function actionViewProdiMatakuliah($id)
    {
        $searchModel = new \common\models\ProdiSearch();
        $dataProvider = $searchModel->searchProdiMatakuliah(Yii::$app->request->queryParams, $id);     
        
        return $this->render('view_prodi_matakuliah', [
            'model' => $this->findModelPengampu($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,  
        ]);
    }     

}
