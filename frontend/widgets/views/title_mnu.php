<?php
use yii\helpers\Url;
?>

<?php if(Yii::$app->controller->module->id == "news"): ?>
    <a href="<?= Url::to(['/news/news/create']) ?>" class="header__main_panel-add-cont"><span class="header-news icon"></span>Предложить новость </a>
    <a href="<?= Url::to(['/news/news/']) ?>" class="all-news"><i class="fa fa-newspaper-o" aria-hidden="true"></i>все новости</a>
<?php elseif (Yii::$app->controller->module->id == "company"): ?>
<!--    <a href="--><?//= Url::to(['/news/news/create']) ?><!--" class="header__main_panel-add-cont"><span class="header-news icon"></span>Предложить новость </a>-->
<!--    <a href="--><?//= Url::to(['/news/news/']) ?><!--" class="all-news"><i class="fa fa-newspaper-o" aria-hidden="true"></i>Все предприятия</a>-->
<?php endif; ?>