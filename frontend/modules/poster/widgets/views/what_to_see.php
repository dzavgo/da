<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 15.04.2017
 * Time: 15:58
 * @var $posters \common\models\db\Poster
 */
use common\classes\WordFunctions;

?>
<div class="what-to-see">
    <h3>Что посмотреть</h3>
    <div class="afisha-events__wrap">
        <?php foreach ($posters as $poster): ?>
            <a href="" class="item">
                <img src="<?= $poster->photo ?>" alt="">
                <div class="item-content">
                    <span class="type"><?= $poster->categories[0]->title ?></span>
                    <span class="name-item"><?= $poster->title ?></span>
                    <span class="time">
                        <?= WordFunctions::dateWithMonts($poster->dt_event) ?>, <?= date('H:i',$poster->dt_event) ?>
                    </span>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
    <span id="more-kino-box"></span>
    <a href="" id="load-more-kino" data-step="2" class="show-more">загрузить БОЛЬШЕ</a>
</div>
