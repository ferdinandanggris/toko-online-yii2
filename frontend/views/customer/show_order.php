<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\model\Customer;


$this->title = 'Show Order';
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>



<h1><?= Html::encode($this->title) ?></h1>


<div class="row">
    <div class="col-md-4">
        <?php foreach ($data as $customer) :
        ?>
            <div class="card my-3" style="">
                <div class="card-body">
                    <h5 class="card-title">Nama : <?= $customer->nama ?></h5>
                    <?php
                    foreach ($customer->orders as $order) :
                    ?>
                        <p class="card-text">Order Id : <?= $order->id; ?>
                        </p>
                        <?php
                        foreach ($order->orderItems as $items) :
                        ?>
                            <p class="card-text">Nama Produk : <?= $items->item->name ?></p>
                        <?php endforeach;
                        ?>
                    <?php endforeach; ?>
                </div>
            </div>
            </tbody>
        <?php
        endforeach;
        ?>
    </div>
</div>