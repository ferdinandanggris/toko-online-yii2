<?php
//Ferdinand Anggris Winarko
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Order */

$this->title = "Order Detail";
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'date',
            'orderItem.item.name',
            'orderItem.item.price',
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::img((Yii::$app->urlManagerFrontend->baseUrl . "/web/uploads/item/" . $data->orderItem->item->image), ['width' => '200']);
                }
            ],
            'customer_id',
        ],
    ]) ?>

</div>