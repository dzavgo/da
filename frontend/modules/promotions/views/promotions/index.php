<?php
/**
 * @var Stock $stock
 * @var array $stocks
 * @var int $sumStocks
 * @var int $step
 * @var bool $isReadMore
 * @var string $request
 */

use common\classes\GeobaseFunction;
use common\models\Time;
use frontend\modules\promotions\models\Stock;
use frontend\widgets\CompanyRight;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

$this->title = "Акции - DA Info";
$this->registerJsFile('/js/stock.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->params['breadcrumbs'][] = 'Акции';

?>

<section class="breadcrumbs-wrap">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => ['class' => 'breadcrumbs']
        ]) ?>
    </div>
</section>
<section class="all-actions">
    <div class="container">
        <div class="all-actions__wrapper">
            <div class="all-actions__header">
                <h1 class="all-actions__title">Все акции компаний</h1>
                <form action="<?= Url::to(['/promotions/promotions/index']); ?>" method="post">
                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                    <button class="all-actions__button-search"></button>
                    <input type="search" name="search" class="all-actions__search" placeholder="Поиск">
                    <ul class="all-actions__select">
                        <li class="init">Текущие и будущие акции</li>
                        <li class="date" data-value="<?= date('Y-m-d', time() - Time::DAY) ?>">
                            Акции за вчера: <?= Yii::$app->formatter->asDate(time() - Time::DAY, 'php:d M'); ?>
                        </li>
                        <li class="date" data-value="<?= date('Y-m-d', time()) ?>">
                            Акции за сегодня: <?= Yii::$app->formatter->asDate(time(), 'php:d M'); ?>
                        </li>
                        <li class="date" data-value="<?= date('Y-m-d', time() + Time::DAY) ?>">
                            Акции за завтра: <?= Yii::$app->formatter->asDate(time() + Time::DAY, 'php:d M'); ?>
                        </li>
                        <li data-value="value 4" class="input-date">Акции на
                            <input class="input-group date" type="text" name="date" data-date-format="yyyy-mm-dd"
                                   placeholder="гггг-мм-дд">
                            <button class="submit-stock">Применить</button>
                        </li>
                    </ul>
                </form>

            </div>
            <div class="all-actions__content">
                <div class="all-actions__desc">
                    У нас Вы найдете информацию об акциях и скидках компаний на электронику, бытовую технику,
                    строительные материалы, мебель, косметику, товары для дома и офиса, услуги и многое другое, то есть
                    всё, что продается в магазинах Вашего города.
                </div>
                <?php
                if (!empty($request)):
                    if (empty($stocks)) {
                        $request .= ' ничего не';
                    }
                    ?>
                    <h3>
                        По запросу <?= $request; ?> найдено:
                    </h3>
                <?php endif; ?>
                <?php
                foreach ($stocks as $stock): ?>
                    <a href="<?= Url::to(['/promotions/promotions/view', 'slug' => $stock->slug]) ?>">
                        <div class="all-actions__item">
                            <div class="all-actions__img">
                                <img src="<?= $stock->photo ?>" alt="">
                            </div>
                            <h2 class="all-actions__title-item"><?= $stock->title; ?>
                                <span class="all-actions__title-item--view"><?= $stock->view; ?></span>
                            </h2>
                            <div class="all-actions__company">
                                <div class="all-actions__company--img">
                                    <img src="<?= $stock->company->photo ?>"
                                         alt="<?= !empty($stock->company->alt) ? $stock->company->alt : $stock->company->name ?>">
                                </div>
                                <h3 class="all-actions__company--title">
                                    <a href="<?= Url::to(['/company/company/view', 'slug' => $stock['company']->slug]); ?>">
                                        <?= $stock->company->name ?>
                                    </a>
                                </h3>
                                <div class="all-actions__company--addres">
                                    <?php
                                    if ($stock->company->region_id != 0)
                                        echo GeobaseFunction::getRegionName($stock->company->region_id) . ', ' . GeobaseFunction::getCityName($stock->company->city_id) . ', ' . $stock->company->address;
                                    else
                                        echo $stock->company->address;
                                    ?>
                                </div>
                            </div>
                            <div class="all-actions__description">
                                <?php
                                if ($stock->short_descr) echo $stock->short_descr;
                                elseif (!empty($stock->descr)) echo mb_substr($stock->descr, 0, 110) . '...';
                                ?>
                            </div>
                            <div class="all-actions__bottom">
                                <a href="<?= Url::to(['/promotions/promotions/view', 'slug' => $stock->slug]) ?>"
                                   class="all-actions__bottom--more">Подробнее</a>
                                <a href="#" data-id="<?= $stock->id ?>" class="all-actions__bottom--comments" id = "promotion_add_comment">Добавить коментарий</a>
                                <span class="all-actions__bottom--sale"><?= $stock->dt_event_description; ?></span>
                            </div>
                            <?php if ($stock->recommended == 1): ?>
                                <div class="all-actions__favorites"></div>
                            <?php endif; ?>
                        </div>
                    </a>
                <?php endforeach; ?>
                <?php if ($isReadMore): ?>
                    <a href=""
                       data-page="1"
                       data-step="<?= $step ?>"
                       data-sum="<?= $sumStocks ?>"
                       id="load-more-company"
                       class="show-more show-more-stock">
                        загрузить больше
                    </a>
                <?php endif; ?>
            </div>

        </div>

        <?= CompanyRight::widget(); ?>

    </div>
</section>

