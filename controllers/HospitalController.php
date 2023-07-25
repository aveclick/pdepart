<?php

namespace app\controllers;

use app\models\Hospital;
use app\models\HospitalSearch;
use app\models\HospitalSearch2;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Hospitalstatus;
use yii;

/**
 * HospitalController implements the CRUD actions for Hospital model.
 */
class HospitalController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    
    public function beforeAction($action){
        if (!parent::beforeAction($action)){
            return false;
        }

        if (Yii::$app->user->isGuest || Yii::$app->user->identity->isAdmin){
            return $this->goHome();
        }

        return true;
    }

    /**
     * Lists all Hospital models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new HospitalSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $hospitalstatuses = Hospitalstatus::getHospitalstatuses();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'hospitalstatuses' => $hospitalstatuses,
        ]);
    }

    public function actionIndex2()
    {
        $searchModel2 = new HospitalSearch2();
        $dataProvider = $searchModel2->search($this->request->queryParams);
        $hospitalstatuses = Hospitalstatus::getHospitalstatuses();
        return $this->render('index2', [
            'searchModel2' => $searchModel2,
            'dataProvider' => $dataProvider,
            'hospitalstatuses' => $hospitalstatuses,
        ]);
    }

    /**
     * Displays a single Hospital model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $hospitalstatuses = Hospitalstatus::getHospitalstatuses();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'hospitalstatuses' => $hospitalstatuses,
        ]);
    }

    /**
     * Creates a new Hospital model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Hospital();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->hospitalstatus_id = 1;
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Hospital model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = Hospital::SCENARIO_DENY;
        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->hospitalstatus_id = Hospitalstatus::getHospitalstatusId('Закрыт');
            $model->end_date = date('Y-m-d');
            $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionExtand($id)
    {
        $model = $this->findModel($id);
        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('extand', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Hospital model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Hospital model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Hospital the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Hospital::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
