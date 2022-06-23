<?php

/** @var yii\web\View $this */

$this->title = 'Toko Baru';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Toko Baru</h1>

        <p class="lead">Silahkan Pilih Produk Kesukaan Anda</p>
    </div>

    <div class="body-content">

        <div class="row">
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
                <a href="../order/create/?id=' . $dt->id . '" class="btn btn-primary">Buat Pesanan</a> '; ?>
                            </div>
                        </div>
                    </div>

                <?php
                endforeach;
                ?>
            </div>
        </div>

    </div>
</div>