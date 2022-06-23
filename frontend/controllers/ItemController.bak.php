<?php
//Ferdinand Anggris Winarko
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Item;
use yii\filters\VerbFilter;

use frontend\models\ItemSearch;
use yii\web\NotFoundHttpException;
use frontend\components\MyComponent;
use frontend\components\LoginChecker;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends Controller
{

    public function __construct()
    {
        Yii::$app->loginChecker->trigger(LoginChecker::ISLOGIN);
    }

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
    // private function actionStatistic()
    // {
    //     Yii::$app->myComponent->trigger(MyComponent::USERACCESSVIEW);
    // }


    public function actionIndex()
    {

        Yii::$app->myComponent->trigger(MyComponent::USERACCESSVIEW);
        $searchModel = new ItemSearch();
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
    public function actionView($id)
    {
        Yii::$app->myComponent->trigger(MyComponent::USERACCESSVIEW);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */

    protected function findModel($id)
    {
        if (($model = Item::findOne(['id' => $id])) !== null) {
            return $model;
        }
    }
}
