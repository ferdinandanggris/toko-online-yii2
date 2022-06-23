<?php
//Ferdinand Anggris Winarko
use yii\helpers\Html;
use frontend\models\User;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin();
    ?>

    <?= $form->field($model, 'date')->textInput(['readonly' => true, 'value' => date("Y-m-d H:i:s")])
    ?>

    <?= $form->field($model, 'customer_id')->textInput(['readonly' => true, 'value' => $user->customer->id]);
    ?>

    <?= $form->field($model3, 'id')->textInput()->textInput(['readonly' => true, 'value' => $item->id])
    ?>

    <div class="form-group">
        <?= Html::submitButton('Beli', ['class' => 'btn btn-success'])
        ?>
    </div>

    <?php ActiveForm::end();
    ?>

</div>