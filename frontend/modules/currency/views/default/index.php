<?php

/**
 * @var array $top_rates
 * @var array $rates
 * @var string $meta_title
 * @var string $meta_descr
 * @var mixed $date
 * @var string $bottom_descr
 * @var boolean $detail
 */

use common\classes\Debug;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

$this->title = $meta_title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $meta_descr,
]);

$this->registerJsFile('/js/raw/currency.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->params['breadcrumbs'][] = ['label' => 'Биржа', 'url' => Url::to(['/finance'])];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="breadcrumbs-wrap">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => ['class' => 'breadcrumbs']
        ]) ?>
    </div>
</section>
<section class="exchange-rates">
    <div class="container">
        <div class="e-content">
            <?= $this->render('_header', ['title' => $meta_title, 'coin' => false]); ?>

            <div class="e-content__wrapper">
                <div class="e-content__wrapper__title">
                    <h2><?= $meta_title ?> на
                        <?= isset($date->date) ?
                            date('d.m.Y', strtotime($date->date)) :
                            date('d.m.Y') ?>
                    </h2>
                    <!-- <a href="#">Архив <i class="fa fa-angle-right" aria-hidden="true"></i></a>-->
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
                                        <?php if ($key !== 'id') : ?>
                                            <?php if ($key == 'rate') : ?>
                                                <div>
                                                    <span><?= $value['now'] ?></span>
                                                    <?php if (isset($value['diff'])): ?>
                                                        <?php if ($value['diff'] > 0): ?>
                                                            <i style="color: #00ff00"
                                                               title="<?= '+' . $value['diff'] ?>">↑</i>
                                                        <?php elseif ($value['diff'] < 0): ?>
                                                            <i style="color: red" title="<?= $value['diff'] ?>">↓</i>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            <?php elseif (($key === 'name') && (!empty($detail))): ?>
                                                <?= Html::a($value, Url::to(['/currency/default/view-coin', 'id' => $rate['id']])) ?>
                                            <?php else: ?>
                                                <?= $value ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?></tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="e-content__wrapper__title">
                    <br/>
                    <br/>
                    <?php if (!empty($detail)): ?>
                        <a href="<?= Url::to(['/currency/default/detail-coin']) ?>">
                            Детальнее<i class="fa fa-angle-right" aria-hidden="true"></i>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="e-content__wrapper__description">
                    <h3>Описание</h3>
                    <?= $bottom_descr; ?>
                </div>
            </div>
            <?= $this->render('_finance_news', ['economicNews' => $economicNews]); ?>
        </div>
        <?= $this->render('_all_charts'); ?>
    </div>
</section>

