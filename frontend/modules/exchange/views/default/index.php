<?php

/** @var array $exchange */
/** @var array $head */
/** @var string $usd */
/** @var string $eur */

use common\classes\Debug;
use yii\helpers\Url;

$this->title = 'Курс валют';
$this->registerMetaTag( [
    'name'    => 'description',
    'content' => 'Курс валют',
] );
?>
<section class="exchange-rates">
    <div class="container">
        <div class="e-content">
            <h1>Курс валют</h1>
            <div class="e-content__header">
                <div class="e-content__header__left">
                    <ul>
                        <li><a href="#">Регион |</a></li>
                        <li><a href="">Банки |</a></li>
                        <li><a href="">ЦРБ |</a></li>
                        <li><a href="">Разные</a></li>
                    </ul>
                </div>
                <div class="e-content__header__right">
                    <ul>
                        <li><a href="<?= Url::to('exchange') ?>">Валюта</a></li>
                        <li><a href="<?= Url::to('metal_rates') ?>">Металлы</a></li>
                        <li><a href="#">Новости</a></li>
                        <li><a href="<?= Url::to('coin') ?>">Криптовалюта</a></li>
                        <li><a href="#">Конвертер</a></li>
                    </ul>
                </div>
            </div>
            <div class="e-content__wrapper">
                <div class="e-content__wrapper__title">
                    <h2>Курсы валют ЦБ РФ на <?= date('d.m.Y', time()) ?></h2>
                    <a href="#">Архив <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                </div>
                <div class="e-content__wrapper__info">
                    <p>
                        Доллар США $ — <span><?= $usd ?> руб.</span>
                    </p>
                    <p>
                        Евро € — <span><?= $eur ?> руб.</span>
                    </p>
                </div>
                <div class="e-content__wrapper__table">
                    <table>
                        <thead>
                        <tr>
                            <td class="digital-code"><?= $head['num_code'] ?><i class="fa fa-sort" aria-hidden="true"></i> </td>
                            <td class="letter-code"><?= $head['char_code'] ?><i class="fa fa-sort" aria-hidden="true"></i></td>
                            <td class="nominal"><?= $head['nominal'] ?><i class="fa fa-sort" aria-hidden="true"></i></td>
                            <td class="currency"><?= $head['name'] ?><i class="fa fa-sort" aria-hidden="true"></i></td>
                            <td class="course">Курс <i class="fa fa-sort" aria-hidden="true"></i></td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        foreach ($exchange as $item) : ?>
                            <tr>
                                <td><?= $item->num_code; ?></td>
                                <td class="currency"><?= $item->char_code ?></td>
                                <td><?= $item->nominal ?></td>
                                <td><?=  $item->name?></td>
                                <td><?=  $item->value?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="e-content__wrapper__description">
                    <h3>Описание</h3>
                    <ol>
                        <li>Среднее значение по курсам крупнейших банков России</li>
                        <li>Коммерческий курс валют расчитывается на основании международного рынка форекс.</li>
                        <li>Курсы VISA обновляются один раз в день около 08:00 по Московскому времени, кроме субботы и воскресенья</li>
                    </ol>
                    <p>Обратите внимание, что курс не учитыает % комиссии банка, выпустившего карту</p>
                </div>
            </div>
        </div>
        <!-- start promotions-sidebar-right.html-->
        <!-- end promotions-sidebar-right.html-->
    </div>
</section>
