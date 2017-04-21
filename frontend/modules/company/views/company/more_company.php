<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 19.04.2017
 * Time: 11:40
 * @var $meta_title \common\models\db\KeyValue
 * @var $meta_descr \common\models\db\KeyValue
 * @var $wrc array
 * @var $positions array
 * @var $organizations \common\models\db\Company
 */
use yii\helpers\Url;

?>
<?php $pos = 0;
$wrc_count = 0; ?>
<?php while($pos < 12): ?>
    <?php if (in_array($pos, $positions, true)): ?>
        <?php $company = isset($wrc[$wrc_count]) ? $wrc[$wrc_count] : $organizations[$pos] ?>
        <a href="<?= Url::to(['/company/company/view', 'slug' => $company->slug]) ?>" class="business__big-item">

            <div class="business__sm-item--img">

                <div class="recommend">
                    <span class="recommend__star"></span>
                    Рекомендуем
                </div>

                <img src="<?= $company->photo ?>" alt="">
            </div>

            <p class="business__sm-item--title">
                <?= $company->name ?>
            </p>

            <p class="business__big-item--address">
                <span>Время работы Министерства:</span>
                <span>с 9:00 до 18:00 (перерыв с 13:00 до 14:00)</span>
            </p>

            <p class="business__sm-item--address">
                <span>Адрес:</span>
                <span><?= $company->address ?></span>
            </p>

            <ul class="business__sm-item--numbers">
                <li>+380667778540</li>
                <li>+380667778540</li>
            </ul>

            <ul class="business__sm-item--numbers">
                <li>+380667778540</li>
                <li>+380667778540</li>
            </ul>

            <!-- <span class="business__sm-item&#45;&#45;views-icon"></span>-->
            <p class="business__sm-item--views"><?= $company->views ?></p>

        </a>
        <?php $pos += 2;$wrc_count++; ?>
    <?php else: ?>
        <a href="<?= Url::to(['/company/company/view', 'slug' => $organizations[$pos]->slug]) ?>" class="business__sm-item">

            <div class="business__sm-item--img">
                <img src="<?= $organizations[$pos]->photo ?>" alt="">
            </div>

            <p class="business__sm-item--title">
                <?= $organizations[$pos]->name ?>
            </p>

            <p class="business__sm-item--address">
                <span>Адрес:</span>
                <span><?= $organizations[$pos]->address ?></span>
            </p>
            <?php $phone = explode(' ', $organizations[$pos]->phone) ?>
            <ul class="business__sm-item--numbers">
                <li><?= $phone[0] ?></li>
                <li> <?= $phone[1] ?></li>
            </ul>

            <!-- <span class="business__sm-item&#45;&#45;views-icon"></span>-->
            <p class="business__sm-item--views"><?= $organizations[$pos]->views ?></p>

        </a>
        <?php $pos++; ?>
    <?php endif; ?>
<?php endwhile; ?>