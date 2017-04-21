<?php use common\classes\WordFunctions;
use yii\helpers\Url;?>
<div class="faq-item">
    <span class="date"><?=

        date( 'd.m.y', $model['dt_add'] ); ?></span>
    <p class="quastion">
        <?= $model['title']; ?>
    </p>
    <p class="answer">
        <?= WordFunctions::crop_str_word(strip_tags($model['content'])); ?>
    </p>

    <a href="<?= Url::to( [ '/consulting/consulting/documentsv', 'slug' => $model['type'],'catslug'=>Yii::$app->request->get()['slugcategory'],'postslug' => $model['slug'] ] ); ?>"
           class="read-answer">Читать статью</a>

    <span class="consult-views-list"><i class="views-ico fa fa-eye"></i><?= $model['views'];?></span>
</div>