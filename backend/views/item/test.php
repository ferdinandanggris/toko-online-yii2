<?php

use yii\helpers\Url; ?>
<!-- <img src="".<?php // var_dump(Yii::$app->request->baseUrl . "../") 
                    ?> alt=""> -->
<?php echo "<img src=' " . Url::to('@web/images/cek.png', true) . "' alt='' srcset=''>" ?>
<?php var_dump(Yii::$app->request->baseUrl . "/../resources");
