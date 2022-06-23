<?php
//Ferdinand Anggris Winarko
namespace frontend\controllers;

use Yii;
use common\models\Item;
use yii\web\Controller;
use frontend\models\Order;
use yii\filters\VerbFilter;
use common\models\OrderItem;
use frontend\models\OrderSearch;
use yii\web\NotFoundHttpException;
use frontend\components\LoginChecker;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
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
     * Lists all Order models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id)
    {
        Yii::$app->loginChecker->trigger(LoginChecker::ISLOGIN);
        $model = new Order();
        // $model2 = new OrderItem();
        $db = Yii::$app->db;

        $model3 = new Item();
        $data3 = $model3->findOne($id);
        // die;
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $db->createCommand()->insert('order_item', ['order_id' => $model->id, 'item_id' => $this->request->post()["Item"]["id"]])->execute();
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return Yii::$app->session->setFlash('error', 'Error while saving');
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'item' => $data3,
            'model3' => $model3,
        ]);
    }



    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
