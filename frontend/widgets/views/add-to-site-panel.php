<div class="fix-button">

    <span class="fix-button__trigger">
        <img src="/theme/portal-donbassa/img/home-content/fix-button.png" alt="">
    </span>

    <ul class="fix-button__list">
        <li><a href="<?= \yii\helpers\Url::to(['/company/company/create'])?>" class="fix-button__list--company">Предприятие</a></li>
        <li><a href="<?= \yii\helpers\Url::to(['/news/news/create'])?>" class="fix-button__list--news">Новость</a></li>
        <li><a href="<?= \yii\helpers\Url::to(['/poster/default/create'])?>" class="fix-button__list--poster">Афиша</a></li>
        <li><a href="#" class="fix-button__list--stock disabled">Акция</a></li>
    </ul>

</div>

<div id="send-error-message" class="fix-button-msg-error">
    <div class="fix-button__notice">
        <img src="/theme/portal-donbassa/img/home-content/mistake-bg.png" alt="">
    </div>
</div>