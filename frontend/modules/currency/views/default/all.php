<?php

/** @var string $meta_title */

/** @var string $meta_descr */
/** @var array $currencyData */
/** @var array $coinData */

/** @var array $metalData */

use common\classes\Debug;
use common\models\db\Currency;
use frontend\widgets\CurrencyRates;

$this->title = $meta_title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $meta_descr,
]);

//echo $this->render('_currency_chart', ['currencyData' => $currencyData]);
//echo $this->render('_coin_chart', ['coinData' => $coinData]);
//echo $this->render('_metal_chart', ['metalData' => $metalData]);

?>
<section class="currency-market">
    <div class="container">
        <div class="e-content">
            <?= $this->render('_header', ['title' => $this->title]); ?>
            <?= CurrencyRates::widget(); ?>
            <?= CurrencyRates::widget(['currencyType' => Currency::TYPE_METAL]); ?>
            <?= CurrencyRates::widget(['currencyType' => Currency::TYPE_COIN]); ?>
            <div class="currency-widget">
                <h1>
                    Описание
                </h1>
                <ol>
                    <li>Среднее значение по курсам крупнейших
                        банков России
                    </li>
                    <li>Коммерческий курс валют расчитывается на
                        основании международного рынка форекс.
                    </li>
                    <li>Курсы VISA обновляются один раз в день около 08:00
                        по Московскому времени, кроме субботы и воскресенья
                        Обратите внимание, что курс не учитыает % комиссии банка,
                        выпустившего карту
                    </li>
                </ol>
            </div>
        </div>
        <div class="promotions-sidebar">
            <?= $this->render('_currency_chart', ['currencyData' => $currencyData]); ?>
            <br>

            <?= $this->render('_coin_chart', ['coinData' => $coinData]); ?>
            <br>

            <?= $this->render('_metal_chart', ['metalData' => $metalData]); ?>
            <br>
        </div>
        <!--        --><? //= \frontend\widgets\ShowRightRecommend::widget() ?>
    </div>
</section>
