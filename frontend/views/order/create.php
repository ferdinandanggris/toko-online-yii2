<?php
//Ferdinand Anggris Winarko
use yii\helpers\Html;
use frontend\models\User;
use yii\widgets\ActiveForm;

$user = new User();
$dataUser = $user->findOne(Yii::$app->user->getId());
/* @var $this yii\web\View */
/* @var $model frontend\models\Order */

$this->title = 'Create Order';
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="card mx-auto" style="width: 50rem;">
        <div class="card-body text-center">
            <p class="card-text"><strong>Date :</strong> <?= date("l,d M Y") ?></p>
            <?= '<img class="rounded mx-auto d-block my-3" style="width:200px" src="' . (Yii::$app->urlManagerFrontend->baseUrl) . "/web/uploads/item/" . $item->image . '" alt="">' ?>

            <h5 class="card-title"> <?= $item->name ?></h5>
            <p class="card-text"><strong>Brand :</strong> <?= $item->category->name ?></p>
            <p class="card-text"><strong>Price :</strong> <?= $item->price ?></p>
            <?= $this->render('_form', [
                'model' => $model,
                'item' => $item,
                'model3' => $model3,
                'user' => $dataUser
            ]) ?>
        </div>
    </div>