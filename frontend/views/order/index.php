<?php
//Ferdinand Anggris Winarko
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Order;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'orderItem.item.name',
            'orderItem.item.price',
            'date',
            [
                'class' => ActionColumn::className(),
                'template' => '{view} ',
                'urlCreator' => function ($action, Order $model, $key, $index, $column) {
                    return Url::toRoute(["view", 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>