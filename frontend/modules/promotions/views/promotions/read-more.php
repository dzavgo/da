<?php
use common\models\User;
?>

<?php
foreach ($stock as $item):  ?>
    <?php if($item->recommended == 1):?>
        <div class="stock__big-item stockBlock" data-id="<?= $item->id; ?>">
            <div class="stock__sm-item--header">
                <?php

                ?>
                <a href="<?= \yii\helpers\Url::to(['/company/company/view', 'slug' => $item['company']->slug] ); ?>" class="title"><?= $item['company']->name ?></a>
                <a href="#" class="like likes <?= User::hasLike('stock', $item->id) ? 'active' : '' ?>"
                   csrf-token="<?= Yii::$app->request->getCsrfToken() ?>"
                   data-id="<?= $item->id; ?>"
                   data-type="stock">
                    <i class="like-set-icon"></i>
                    <span class="like-counter"><?= $item->getLikesCount() ?></span>
                </a>
            </div>
            <a href="<?= $item->link ?>" target="_blank" class="stock__sm-item--img stockView">
                <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($item->photo); ?>" alt="">
            </a>
            <a href="<?= $item->link ?>" target="_blank" class="stock__sm-item--descr stockView">
                <p><?= $item->short_descr ?></p>
                <span class="views"><?= $item->view?></span>
            </a>
            <a href="<?= $item->link ?>" target="_blank"  class="stock__sm-item--time stockView">
                <p><?= $item->dt_event ?></p>
            </a>
        </div>
    <?php else:?>
        <div class="stock__sm-item stockBlock" data-id="<?= $item->id; ?>">
            <div class="stock__sm-item--header">
                <a href="<?= \yii\helpers\Url::to(['/company/company/view', 'slug' => $item['company']->slug] ); ?>" class="title"><?= $item['company']->name ?></a>
                <a href="#" class="like likes <?= User::hasLike('stock', $item->id) ? 'active' : '' ?>"
                   csrf-token="<?= Yii::$app->request->getCsrfToken() ?>"
                   data-id="<?= $item->id; ?>"
                   data-type="stock">
                    <i class="like-set-icon"></i>
                    <span class="like-counter"><?= $item->getLikesCount() ?></span>
                </a>
            </div>
            <a href="<?= $item->link ?>" target="_blank" class="stock__sm-item--img stockView">
                <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($item->photo); ?>" alt="">
            </a>
            <a href="<?= $item->link ?>" target="_blank" class="stock__sm-item--descr stockView">
                <p><?= $item->short_descr ?></p>
                <span class="views"><?= $item->view?></span>
            </a>
            <a href="<?= $item->link ?>" target="_blank"  class="stock__sm-item--time stockView">
                <p><?= $item->dt_event ?></p>
            </a>
        </div>
    <?php endif; ?>
<?php endforeach; ?>