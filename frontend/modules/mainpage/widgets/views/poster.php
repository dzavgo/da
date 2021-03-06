<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 11.10.2016
 * Time: 15:27
 * @var $dataProvider \yii\data\SqlDataProvider
 * @var $one_poster \common\models\db\Poster
 */
use common\classes\DateFunctions;

?>

<div class="title">
    <div class="title-left-side title-full-width">
        <h2>афиша</h2>
        <div class="title-right">
            <a href="<?= \yii\helpers\Url::to(['/all-poster']) ?>" class="all-news">вся афиша</a>
        </div>
    </div>
</div>
<div class="afisha">
    <div class="afisha__left">
        <div class="afisha__main">
            <div class="thumb">
                <span class="afisha-date"><b><?= date('d', $one_poster[0]->dt_event) ?></b> <?= DateFunctions::getMonthShortName(date('m', $one_poster[0]->dt_event)) ?></span>
                <img src="<?= $one_poster[0]->photo ?>" alt="">
            </div>
            <div class="about">
                <p>Афиша:: <?= \frontend\modules\poster\models\Poster::getCategoryName($one_poster[0]->id) ?></p>
                <h2><?= $one_poster[0]->title ?></h2>
                <p><?= $one_poster[0]->short_descr ?></p>
            </div>
        </div>
    </div>
    <div class="afisha__right">
        <?= \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_poster_item',
            'layout' => "{items}",
        ]); ?>
    </div>
</div>


