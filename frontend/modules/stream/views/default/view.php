<?php
use common\classes\DateFunctions;
use frontend\widgets\ShowRightRecommend;
use common\models\User;
use common\classes\Debug;

$this->title = '';

$this->registerJsFile('/theme/portal-donbassa/js/mansory.js', ['depends' => \yii\web\JqueryAsset::className()]);
$this->registerJsFile('/js/stream_new_post.js', ['depends' => \yii\web\JqueryAsset::className()]);
?>
<section class="parser">

    <div class="container">

        <h3 class="parser__title">О чем говорят в городе</h3>

        <div class="business__wrapper">

            <div class="business__content">

                <div class="parser__top-counter">

                    <a href="<?= \yii\helpers\Url::to(['/stream/default'])?>">Показать
                        <span class="counter counter-stream-new" data-count="<?= $count?>">0</span> новых записи</a>

                </div>

                <div class="parser__top-link">

                    <a href="#">Подписаться на эту тему</a>

                </div>

                <ul class="parser__top-nav">
                    <li><a href="#">Все материалы <span><?= $count?></span></a></li>
                    <li><a href="<?= \yii\helpers\Url::to(['/stream/default'])?>">ВК
                            <span><?= $count?></span></a></li>
                </ul>

                <div class="parser__single-wrapper">

                    <div class="parser__element">

                        <a href="#" class="parser__element--author">

                            <div class="avatar">

                                <?php if (!empty($model->author)): ?>
                                    <img src="<?= $model->author->photo ?>" alt="">
                                <?php endif; ?>
                                <?php if (!empty($model->group)): ?>

                                <?php endif; ?>
                            </div>

                            <div class="name">
                                <?php if (!empty($model->group)): ?>
                                    <?= $model->group->name ?>
                                <?php endif; ?>

                                <?php if (!empty($model->author)): ?>
                                    <?= $model->author->first_name . ' ' . $model->author->last_name ?>
                                <?php endif; ?>
                            </div>

                            <span class="date"><?= DateFunctions::getGetNiceDate($model->dt_add) ?></span>

                        </a>

                        <div class="social-wrap__item vk">
                            <img src="/theme/portal-donbassa/img/soc/vk.png" alt="vk">
                        </div>

                        <h3 class="parser__element--title"></h3>

                        <p class="parser__element--descr"><?= $model->text?> </p>

                        <?php if (!empty($model->photo)): ?>
                            <a data-fancybox="gallery" class="parser__element--photo"
                               href="<?= $model->photo[0]->getLargePhoto() ?>">
                                <img src="<?= $model->photo[0]->getLargePhoto() ?>" alt="">
                            </a>
                        <?php endif; ?>

                        <div class="parser__element--tools">

                            <a href="#" class="like likes <?= User::hasLike('stream', $model->id) ? 'active' : '' ?>"
                               csrf-token="<?= Yii::$app->request->getCsrfToken() ?>"
                               data-id="<?= $model->id; ?>"
                               data-type="stream">
                                <i class="like-set-icon"></i>
                                <span class="like-counter"><?= $model->getLikesCount() ?></span>
                            </a>

                            <a href="#" class="comments"><?= count($model->comments)?></a>

                            <a href="#" class="views"><?= $model->views?></a>

                        </div>

                        <div class="parser__element--comments-block">
                            <?php if (!empty($model->comments)): ?>
                                <?php foreach ($model->comments as $comment): ?>
                                    <div class="avatar">
                                        <img src="<?= $comment->author['photo']?>" alt="">
                                    </div>

                                    <div class="name">
                                        <?= $comment->author['first_name'] . ' ' . $comment->author['last_name'] ?>
                                    </div>

                                    <p><?= $comment->text ?></p>
                                <?php endforeach; ?>
                            <?php endif; ?>

                    </div>

                </div>

                <h3 class="parser__title">Самое интересное по теме</h3>

                <div class="parser__wrapper">

                    <div id="first-column" class="parser__column">
                        <?php foreach ($interested1 as $item): ?>
                            <div class="parser__element <?= $item->id ?>">

                                <a href="<?= \yii\helpers\Url::to(['/stream/default/view', 'id' => $item->id])?>" class="parser__element--author">

                                    <div class="avatar">
                                        <?php if (!empty($item->author)): ?>
                                            <img src="<?= $item->author->photo ?>" alt="">
                                        <?php endif; ?>
                                        <?php if (!empty($item->group)): ?>

                                        <?php endif; ?>
                                    </div>

                                    <div class="name">
                                        <?php if (!empty($item->group)): ?>
                                            <?= $item->group->name ?>
                                        <?php endif; ?>

                                        <?php if (!empty($item->author)): ?>
                                            <?= $item->author->first_name . ' ' . $item->author->last_name ?>
                                        <?php endif; ?>
                                    </div>

                                    <span class="date"><?= DateFunctions::getGetNiceDate($item->dt_add) ?></span>

                                </a>

                                <div class="social-wrap__item vk">
                                    <img src="/theme/portal-donbassa/img/soc/vk.png" alt="vk">
                                </div>

                                <!--<h3 class="parser__element--title">F-Secure рассказала об опасностях пиратских версий-->
                                <!--    Windows</h3>-->

                                <?php if (!empty($item->text)): ?>

                                    <p class="parser__element--descr"><?= $item->text ?></p>
                                    <?php if (mb_strlen($item->text) > 131): ?>
                                        <a href="#" class="parser__element--more">читать далее</a>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if (!empty($item->photo)): ?>
                                    <a data-fancybox="gallery" class="parser__element--photo"
                                       href="<?= $item->photo[0]->getLargePhoto() ?>">
                                        <img src="<?= $item->photo[0]->getLargePhoto() ?>" alt="">
                                    </a>
                                <?php endif; ?>

                                <div class="parser__element--tools">

                                    <a href="#" class="like likes <?= User::hasLike('stream', $item->id) ? 'active' : '' ?>"
                                       csrf-token="<?= Yii::$app->request->getCsrfToken() ?>"
                                       data-id="<?= $item->id; ?>"
                                       data-type="stream">
                                        <i class="like-set-icon"></i>
                                        <span class="like-counter"><?= $item->getLikesCount() ?></span>
                                    </a>

                                    <a href="#" class="views"><?= $item->views ?></a>

                                    <a href="#" class="comments">
                                        <?= count($item->comments) ?>
                                    </a>

                                </div>

                                <div class="parser__element--comments-block">

                                    <?php if (!empty($item->comments)): ?>
                                        <?php foreach ($item->comments as $comment): ?>
                                            <div class="avatar">
                                                <img src="<?= $comment->author['photo'] ?>" alt="">
                                            </div>

                                            <div class="name">
                                                <?= $comment->author['first_name'] . ' ' . $comment->author['last_name'] ?>
                                            </div>

                                            <p><?= $comment->text ?></p>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                </div>

                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div id="second-column" class="parser__column">
                        <?php foreach ($interested2 as $item): ?>
                        <div class="parser__element <?= $item->id ?>">

                            <a href="<?= \yii\helpers\Url::to(['/stream/default/view', 'id' => $item->id])?>" class="parser__element--author">

                                <div class="avatar">
                                    <?php if (!empty($item->author)): ?>
                                        <img src="<?= $item->author->photo ?>" alt="">
                                    <?php endif; ?>
                                    <?php if (!empty($item->group)): ?>

                                    <?php endif; ?>
                                </div>

                                <div class="name">
                                    <?php if (!empty($item->group)): ?>
                                        <?= $item->group->name ?>
                                    <?php endif; ?>

                                    <?php if (!empty($item->author)): ?>
                                        <?= $item->author->first_name . ' ' . $item->author->last_name ?>
                                    <?php endif; ?>
                                </div>

                                <span class="date"><?= DateFunctions::getGetNiceDate($item->dt_add) ?></span>

                            </a>

                            <div class="social-wrap__item vk">
                                <img src="/theme/portal-donbassa/img/soc/vk.png" alt="vk">
                            </div>

                            <!--<h3 class="parser__element--title">F-Secure рассказала об опасностях пиратских версий-->
                            <!--    Windows</h3>-->

                            <?php if (!empty($item->text)): ?>

                                <p class="parser__element--descr"><?= $item->text ?></p>
                                <?php if (mb_strlen($item->text) > 131): ?>
                                    <a href="#" class="parser__element--more">читать далее</a>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if (!empty($item->photo)): ?>
                                <a data-fancybox="gallery" class="parser__element--photo"
                                   href="<?= $item->photo[0]->getLargePhoto() ?>">
                                    <img src="<?= $item->photo[0]->getLargePhoto() ?>" alt="">
                                </a>
                            <?php endif; ?>

                            <div class="parser__element--tools">

                                <a href="#" class="like likes <?= User::hasLike('stream', $item->id) ? 'active' : '' ?>"
                                   csrf-token="<?= Yii::$app->request->getCsrfToken() ?>"
                                   data-id="<?= $item->id; ?>"
                                   data-type="stream">
                                    <i class="like-set-icon"></i>
                                    <span class="like-counter"><?= $item->getLikesCount() ?></span>
                                </a>

                                <a href="#" class="views"><?= $item->views ?></a>

                                <a href="#" class="comments">
                                    <?= count($item->comments) ?>
                                </a>

                            </div>

                            <div class="parser__element--comments-block">

                                <?php if (!empty($item->comments)): ?>
                                    <?php foreach ($item->comments as $comment): ?>
                                        <div class="avatar">
                                            <img src="<?= $comment->author['photo'] ?>" alt="">
                                        </div>

                                        <div class="name">
                                            <?= $comment->author['first_name'] . ' ' . $comment->author['last_name'] ?>
                                        </div>

                                        <p><?= $comment->text ?></p>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </div>

                        </div>
                    <?php endforeach; ?>
                    </div>
                        <!--<span class="stream-flag"></span>-->
                    </div>

                <div class="parser__more">

                    <a href="#"  class="show-more show-more-stream" data-step="1" csrf-token="<?= Yii::$app->request->getCsrfToken() ?>">загрузить еще</a>

                </div>


            </div>



        </div>
            <?= ShowRightRecommend::widget() ?>

        </div>

    </div>

</section>
