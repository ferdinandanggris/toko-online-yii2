<?php
//Ferdinand Anggris Winarko
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\ItemCategory */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Item Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="item-category-view">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>


    <?php /* DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'parent_category',
        ],
    ]) */ ?>

    <div class="row">
        <?php foreach ($model->items as $item) : ?>

            <div class="col-4 my-3">
                <div class="card" style="width: 18rem;">
                    <?= '<img class="mx-5 my-5" style="width:200" src="' . (Yii::$app->urlManagerFrontend->baseUrl) . "/web/uploads/item/" . $item->image . '" alt="">' ?>
                    <div class="card-body">
                        <h5 class="card-title"> <?= $item->name ?></h5>
                        <p class="card-text"><strong>Price :</strong> <?= $item->price ?></p>

                        <?= '
                     <a href="' . Yii::$app->urlManagerFrontend->baseUrl . "/web/order/create/?id=" . $item->id . '" class="btn btn-primary">Buat Pesanan</a> '; ?>
                    </div>
                </div>
            </div>

        <?php endforeach ?>
    </div>

    <?= \yii\widgets\LinkPager::widget([
        'pagination' => $pages,
        'options' => ['class' => 'pagination justify-content-center'],
    ]) ?>
</div>