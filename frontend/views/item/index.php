<?php
//Ferdinand Anggris Winarko
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Item;
use yii\grid\ActionColumn;
use yii\bootstrap4\Accordion;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
?>

<h1 class="text-center"><?= Html::encode($this->title) ?></h1>

<?php // echo $this->render('_search', ['model' => $searchModel]);
?>

<?php /* GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'name',
        'price',
        'category.name',

    ],
]); */ ?>

<?php // var_dump(Yii::$app->urlManagerFrontend->baseUrl);
?>

<div class="row">

    <?php
    foreach ($data as $dt) :
    ?>
        <div class="col-4 my-3">
            <div class="card" style="width: 18rem;">
                <?= '<img class="mx-5 my-5" style="width:200" src="' . (Yii::$app->urlManagerFrontend->baseUrl) . "/web/uploads/item/" . $dt->image . '" alt="">' ?>
                <div class="card-body">
                    <h5 class="card-title"> <?= $dt->name ?></h5>
                    <p class="card-text"><strong>Brand :</strong> <?= $dt->category->name ?></p>
                    <p class="card-text"><strong>Price :</strong> <?= $dt->price ?></p>

                    <?= '
                    <a href="' . Yii::$app->urlManagerFrontend->baseUrl . "/web/order/create/?id=" . $dt->id . '" class="btn btn-primary">Buat Pesanan</a> '; ?>
                </div>
            </div>
        </div>

    <?php
    endforeach;
    ?>

    <?= \yii\widgets\LinkPager::widget([
        'pagination' => $pages,
        'options' => ['class' => 'pagination justify-content-center'],
    ]) ?>
</div>