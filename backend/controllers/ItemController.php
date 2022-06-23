<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Item;
use yii\filters\VerbFilter;
use backend\models\itemSearch;
use GuzzleHttp\Psr7\UploadedFile;
use yii\web\NotFoundHttpException;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends Controller
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

    /**
     * Lists all Item models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new itemSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Item model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionTest()
    {
        return $this->render('test', []);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Item();
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $instance = \yii\web\UploadedFile::getInstance($model, 'image');
                $filename = Yii::$app->security->generateRandomString(32) . '.' . $instance->extension;
                $model->image = $filename;

                if ($model->validate()) {
                    $model->save();
                    $instance->saveAs($model->getUploadedPath() . $filename);
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Error while saving');
                }
            } else {
                $model->loadDefaultValues();
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Item model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $old_file = $model->image;

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $instance = \yii\web\UploadedFile::getInstance($model, 'image');
                $filename = Yii::$app->security->generateRandomString(32) . '.' . $instance->extension;
                if ($instance) {
                    $model->image = $filename;
                } else {
                    $model->image = $old_file;
                }
                if ($model->validate()) {
                    $model->save();
                    if ($instance) {
                        $instance->saveAs($model->getUploadedPath() . $filename);
                        unlink($model->getUploadedPath() . $old_file);
                    }
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {

                    Yii::$app->session->setFlash('error', 'Error while saving');
                }
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Item model.
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
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Item::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
