<?php

use common\classes\DateFunctions;
use common\classes\WordFunctions;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\news\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/**
 * @var $cat \common\models\db\CategoryNews
 * @var $news_5 \common\models\db\News
 * @var $meta_title string
 * @var $meta_descr string
 * @var $hotNews \common\models\db\News
 */
//$this->title                   = Yii::t( 'news', 'News' );
$this->params['breadcrumbs'][] = $this->title;
$this->title = $meta_title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $meta_descr,
]);
$md = new \common\classes\Mobile_Detect();
?>

<section class="news">
    <div class="container">
        <div class="news-slider-index-panel">
            <h3>Горячие темы</h3>
            <div class="buttons-wrap">
                <a href="">подписаться</a>

            </div>
            <!--<div class="hot-tag">-->
            <!--    <a href="">Криптовалюты </a>-->
            <!--    <a href="">Дональд Трамп</a>-->
            <!--    <a href="">ОПЕК</a>-->
            <!--    <a href="">Китай Tesla </a>-->
            <!--</div>-->
        </div>
        <div class="news__wrap">

            <?php
            $simpleNewId = 0;
            $hotNewId = 0;
            for ($i = 0; $i <= 38; $i++):
                if (!in_array($i, $hotNewsIndexes)):
                    $currNew = $news[$simpleNewId];
                    if (in_array($i, $bigNewsIndexes)):
                        ?>
                        <a href="<?= Url::to([
                            '/news/default/view',
                            'slug' => $currNew->slug,
                        ]); ?>" class="news__wrap_item-lg">
                            <div class="thumb">
                                <img src="<?= $currNew->photo; ?>" alt="">
                                <div class="content-row">
                                    <span><?= WordFunctions::dateWithMonts($currNew->dt_public); ?></span>
                                    <span>Новости</span>
                                    <span><small class="view-icon"></small> <?= $currNew->views; ?></span>
                                    <h2><?= $currNew->title; ?></h2>
                                </div>

                            </div>
                        </a>
                    <?php else: ?>
                        <div class="news__wrap_item-sm">
                            <!-- thumb -->
                            <a href="<?= Url::to([
                                '/news/default/view',
                                'slug' => $currNew->slug,
                            ]); ?>" class="thumb">
                                <img src="<?= $currNew->photo; ?>" alt="">
                                <div class="content-row">
                                    <span><small class="view-icon"></small> <?= $currNew->views; ?></span>
                                    <span >Новости</span>
                                </div>
                            </a>
                            <!-- thumb -->
                            <div class="content-item">
                                <p><a href="<?= Url::to([
                                        '/news/default/view',
                                        'slug' => $currNew->slug,
                                    ]); ?>"><?= $currNew->title; ?></a></p>
                                <span><?= WordFunctions::dateWithMonts($currNew->dt_public); ?></span>
                            </div>
                        </div>
                        <?php
                    endif;
                    $simpleNewId++;
                else:

                    $currHotNew = $hotNews[$hotNewId];
                    ?>
                    <a href="<?= Url::to([
                        '/news/default/view',
                        'slug' => $currHotNew->slug,
                    ]); ?>" class=" news__wrap_item-sm-hot">
                        <!-- thumb -->
                        <div class="thumb">
                            <img src="<?= $currHotNew->photo; ?>" alt="">
                            <div class="content-row">
                                <span><small class="view-icon"></small> 2589</span>
                                <span>Новости</span>
                            </div>
                        </div>
                        <!-- thumb -->
                        <div class="hover-wrap">
          <span class="category">
            <span class="category-star"></span>
            ГОРЯЧЕЕ
          </span>
                            <h2><?= $currHotNew->title; ?></h2>
                        </div>
                    </a>


                    <?php
                    $hotNewId = $hotNewId + 1 == count($hotNews) ? 0 : $hotNewId + 1;
                endif;
            endfor; ?>


            <div class="home-content__wrap_subscribe">
                <div class="subscribe__wrap">
                    <h3>ПОДПИСАТЬСЯ НА НОВОСТИ</h3>
                    <form action="">
                        <input type="text" placeholder="Выслать на email">
                        <button>подписаться</button>
                    </form>
                    <div class="social-wrap">
                        <h4>мы в социальных сетях</h4>
                        <a href="https://vk.com/da_info_pro" class="social-wrap__item vk">
                            <img src="/theme/portal-donbassa/img/soc/vk.png" alt="">
                        </a>
                        <a href="https://www.facebook.com/da.info.pro/" class="social-wrap__item fb">
                            <img src="/theme/portal-donbassa/img/soc/fb.png" alt="">
                        </a>
                        <a href="https://ok.ru/da...infor" class="social-wrap__item ok">
                            <img src="/theme/portal-donbassa/img/soc/ok-icon.png" alt="">
                        </a>
                        <a href="https://www.instagram.com/da.info.pro/" class="social-wrap__item insta">
                            <img src="/theme/portal-donbassa/img/soc/insta-icon.png" alt="">
                        </a>
                        <a href="" class="social-wrap__item twitter">
                            <img src="/theme/portal-donbassa/img/soc/twi-icon.png" alt="">
                        </a>
                        <a href="" class="social-wrap__item google">
                            <img src="/theme/portal-donbassa/img/soc/google-icon.png" alt="">
                        </a>
                        <a href="" class="social-wrap__item pinterest">
                            <img src="/theme/portal-donbassa/img/soc/pinter-icon.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="news__wrap_buttons">
            <a href="#go_rubricator" class="businessScroll"><span class="rotate-arrow"></span>рубрикатор</a>
            <a
                    href=""
                    data-offset="34"
                    csrf-token="<?= Yii::$app->getRequest()->getCsrfToken(); ?>"
                    class="show-more show-more-news-js">загрузить
                БОЛЬШЕ</a>
            <span href="#" class="archive-news datepicker-here datepicker-wrap">архив новостей</span>
        </div>
    </div>
</section>

<?= \frontend\modules\news\widgets\PeopleTalk::widget(); ?>

<?= \frontend\modules\news\widgets\RubricSlider::widget(); ?>



