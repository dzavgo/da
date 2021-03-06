<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 14.06.2017
 * Time: 17:21
 */

use common\classes\WordFunctions;
use frontend\modules\search\models\Search;
use yii\helpers\Html;


//\common\classes\Debug::prn($model['descr']);
/*\common\classes\Debug::prn(\frontend\modules\search\models\Search::getTypeLabel($model['material_type']));*/
?>


<!--<h2><?php /*echo \yii\helpers\Html::a(\yii\helpers\Html::encode($model->title), $model->material->url)*/ ?></h2>-->
<a href="<?= $model['url']; ?>" class="search-content__item">

    <p class="search-content__item--title"><?= Search::getTypeLabel($model['material_type']); ?></p>

    <div class="search-content__item--img">
        <?php if ($model->photo): ?>
            <img src="<?= $model['photo'] ?>" alt="">
        <?php endif ?>
    </div>

    <div class="search-content__item--content">

        <h3><?= $model['title']; ?></h3>
        <span><?= WordFunctions::dateWithMonts($model['dt_update']); ?></span>
        <!--<p><? /*= yii\helpers\StringHelper::truncate(\yii\helpers\Html::encode($model['descr']),150,'...'); */ ?></p>-->

        <?= Html::tag('p', yii\helpers\StringHelper::truncate(strip_tags($model['descr']), 150, '...')) ?>

    </div>

</a>