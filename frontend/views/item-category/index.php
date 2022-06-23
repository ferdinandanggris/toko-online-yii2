<?php
//Ferdinand Anggris Winarko
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use frontend\models\ItemCategory;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ItemCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Item Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-category-index">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?php /* GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'parent_category',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ItemCategory $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); */ ?>


    <div class="row  justify-content-center">
        <?php foreach ($categories as $category) : ?>
            <div class="col-4 my-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title text-center"> <?= $category->name ?></h5>
                        <?= '
                <a href="' . Yii::$app->urlManagerFrontend->baseUrl . "/web/item-category/view/?id=" . $category->id . '" class="btn btn-primary mx-auto d-block">Show Products</a> '; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>