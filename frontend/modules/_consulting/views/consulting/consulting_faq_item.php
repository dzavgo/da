<?php use yii\helpers\Url;

$this->title = (empty($faq->meta_title)) ? $faq->question : $faq->meta_title;
$this->registerMetaTag( [
    'name'    => 'description',
    'content' => $posts->meta_descr,
] );
; ?>
<div class="consult-item">
    <div class="consult-item-mnu">
        <p class="consult-img">
            <i class="fa <?= $consulting->icon; ?>"></i>
        </p>

        <h4><?= $consulting->title; ?></h4>

        <div class="shape">
            <img src="/theme/portal-donbassa/img/shape-line.png" alt="">
        </div>
        <ul class="consult-item-mnu-menu end">
            <?php if($consulting->about_company): ?>
                <li>
                    <a href="<?= Url::to( [ "/consulting/consulting/view", 'slug' => $consulting->slug ] ); ?>"><span
                            class="marker"></span>О компании</a>
                </li>
            <?php endif; ?>
            <?php if($consulting->documents): ?>
                <li>
                    <a href="<?= Url::to( [ '/documents/' . $consulting->slug ] ) ?>"><span class="marker"></span><?= $consulting->title_digest;?></a>
                </li>
            <?php endif; ?>
            <?php if($consulting->posts): ?>
                <li>
                    <a href="<?= Url::to( [ '/posts/' . $consulting->slug ] ) ?>"><span class="marker"></span>Статьи</a>
                </li>
            <?php endif; ?>
            <?php if($consulting->faq): ?>
                <li>
                    <a class="active" faq-id="0" href="<?= Url::to( [ '/faq/' . $consulting->slug ] ) ?>"><span
                            class="marker"></span>Вопрос / ответ</a>
                    <?= \frontend\modules\consulting\widgets\GenerateCatTree::widget( [
                        'categories' => $categories_faq,
                        'id_attr'        => 'faq-id',
                        'active_id'      => $active_id,
                        'url'            => $url,
                    ] ); ?>
    
                </li>
            <?php endif; ?>
        </ul>
    </div>
    <div class="consult-item-content">
        <div class="faq">
            <form class="consult-search-form" action="#">
                <input class="consult-search" type="text" placeholder="найти в разделе">
                <input type="submit" value="искать">
            </form>
            <div class="clearfix"></div>
            <span class="consult-views"><i class="views-ico fa fa-eye"></i><?= $faq['views'];?></span>
<!--            <h3 class="faq-section">--><?//= $cat_faq; ?><!--</h3>-->
            <div class="faq-items">
                <div class="faq-item">
                    <span class="date"><?= date( 'd.m.y', $faq->dt_add ); ?></span>
                    <p class="quastion">
                        <?= $faq->question; ?>
                    </p>
                    <p class="answer">
                        <?= $faq->answer; ?>
                    </p>
                    <?php if ( ! empty( \common\models\db\KeyValue::find()->where( [ 'key' => 'likes_for_faq' ] )->one()->value ) ): ?>
                        <a data-id="<?= $faq->id; ?>" data-type="faq" class="likes"><i
                                class="like_icon <?= ( empty( $user_set_like ) ? '' : 'like_icon-set' ); ?>"></i><span
                                class="like-count"><?= $count_likes; ?></span></a>
                    <?php endif; ?>
                    <a href="<?= Url::to( [ '/consulting/consulting/faq', 'slugcategory' => $category->slug ] ); ?>" class="read-answer">Вернуться
                        в
                        раздел</a>
                </div>
            </div>
        </div>
    </div>

</div>
<?= \frontend\widgets\Comments::widget([
    'post_id'=>$faq->id,
    'post_type'=>'faq',
]); ?>