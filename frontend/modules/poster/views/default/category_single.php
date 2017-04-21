<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 13.10.2016
 * Time: 11:31
 * @var $category \common\models\db\CategoryPoster
 * @var $dataProvider \yii\data\SqlDataProvider
 * @var $meta_title \backend\modules\key_value\Key_value
 * @var $meta_descr \backend\modules\key_value\Key_value
 * @var $slug string
 */
use yii\helpers\Url;
$this->title = $meta_title;
$this->registerMetaTag( [
    'name'    => 'description',
    'content' => $meta_descr,
] );

$this->registerJsFile('/js/poster.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<?= \frontend\modules\poster\widgets\Banner::widget(); ?>

<?= \frontend\modules\poster\widgets\Categories::widget(); ?>

<?= \frontend\modules\poster\widgets\TopSlider::widget(); ?>

<section class="afisha-events">
    <div class="container">
        <?= \frontend\modules\poster\widgets\EventsInComing::widget(['slug' => $slug]) ?>
        <?= \frontend\modules\poster\widgets\WhatToSee::widget() ?>
        <!--<div class="where-to-go">
            <h3>Куда сходить</h3>
            <div class="afisha-events__wrap">
                <a href="" class="item">
                    <img src="theme/portal-donbassa/img/home-content/afisha-pic.png" alt="">
                    <div class="item-content">
                        <span class="type">Концерт / Рок</span>
                        <span class="name-item">Закон ночи</span>
                        <span class="time">"28 января 09:00"</span>
                    </div>
                </a>
                <a href="" class="item">
                    <img src="theme/portal-donbassa/img/home-content/afisha-pic.png" alt="">
                    <div class="item-content">
                        <span class="type">Концерт / Рок</span>
                        <span class="name-item">Закон ночи</span>
                        <span class="time">"28 января 09:00"</span>
                    </div>
                </a>
                <a href="" class="item">
                    <img src="theme/portal-donbassa/img/home-content/afisha-pic.png" alt="">
                    <div class="item-content">
                        <span class="type">Концерт / Рок</span>
                        <span class="name-item">Закон ночи</span>
                        <span class="time">"28 января 09:00"</span>
                    </div>
                </a>
                <a href="" class="item">
                    <img src="theme/portal-donbassa/img/home-content/afisha-pic.png" alt="">
                    <div class="item-content">
                        <span class="type">Концерт / Рок</span>
                        <span class="name-item">Закон ночи</span>
                        <span class="time">"28 января 09:00"</span>
                    </div>
                </a>
                <a href="" class="item">
                    <img src="theme/portal-donbassa/img/home-content/afisha-pic.png" alt="">
                    <div class="item-content">
                        <span class="type">Концерт / Рок</span>
                        <span class="name-item">Закон ночи</span>
                        <span class="time">"28 января 09:00"</span>
                    </div>
                </a>
            </div>
            <a href="" class="show-more">загрузить БОЛЬШЕ</a>
        </div>-->
        <?= \frontend\modules\poster\widgets\InterestedIn::widget() ?>
    </div>
</section>