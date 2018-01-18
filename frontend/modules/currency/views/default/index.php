<?php

/** @var array $top_rates */
/** @var array $rates */
/** @var string $meta_title */
/** @var string $meta_descr */

/** @var mixed $date */

use common\classes\Debug;
use yii\helpers\Url;

$this->title = $meta_title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $meta_descr,
]);
?>
<section class="exchange-rates">
    <div class="container">
        <div class="e-content">
            <?= $this->render('_header', ['title' => $meta_title]); ?>

            <div class="e-content__wrapper">
                <div class="e-content__wrapper__title">
                    <h2><?= $meta_title ?> на
                        <?= isset($date->date) ?
                            date('d.m.Y', strtotime($date->date)) :
                            date('d.m.Y') ?>
                    </h2>
                    <a href="#">Архив <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                </div>
                <div class="e-content__wrapper__info">
                    <?php foreach ($top_rates as $rate): ?>
                        <p><?= $rate[0] ?> — <span> <?= $rate[1] ?></span></p>
                    <?php endforeach; ?>
                </div>
                <div class="e-content__wrapper__table">
                    <table>
                        <thead>
                        <tr><?php foreach ($rates['titles'] as $title): ?>
                                <td class="<?= $title['class'] ?>"><?= $title['value'] ?>
                                    <i class="fa fa-sort" aria-hidden="true"></i></td>
                            <?php endforeach; ?></tr>
                        </thead>
                        <tbody>
                        <?php foreach ($rates['rates'] as $rate): ?>
                            <tr><?php foreach ($rate as $key => $value): ?>
                                    <td>
                                        <?php if ($key == 'rate') : ?>
                                            <div>
                                                <span><?= $value['now'] ?></span>
                                                <?php if ($value['diff'] > 0): ?>
                                                    <i style="color: #00ff00" title="<?= '+' . $value['diff'] ?>">↑</i>
                                                <?php elseif ($value['diff'] < 0): ?>
                                                    <i style="color: red" title="<?= $value['diff'] ?>">↓</i>
                                                <?php endif; ?>
                                            </div>
                                        <?php else: ?>
                                            <?= $value ?>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?></tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="e-content__wrapper__description">
                    <h3>Описание</h3>
                    <ol>
                        <li>Среднее значение по курсам крупнейших банков России</li>
                        <li>Коммерческий курс валют расчитывается на основании международного рынка форекс.</li>
                        <li>Курсы VISA обновляются один раз в день около 08:00 по Московскому времени, кроме субботы и
                            воскресенья
                        </li>
                    </ol>
                    <p>Обратите внимание, что курс не учитыает % комиссии банка, выпустившего карту</p>
                </div>
            </div>
        </div>
        <div class="promotions-sidebar">
            <?= $this->render('_currency_chart', ['count_day' => 14]); ?>
            <br>

            <?= $this->render('_coin_chart', ['count_day' => 14]); ?>
            <br>

            <?= $this->render('_metal_chart', ['count_day' => 14]); ?>
            <br>
        </div>
        <!--        --><? //= \frontend\widgets\ShowRightRecommend::widget() ?>
    </div>
</section>

