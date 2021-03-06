<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 29.09.2016
 * Time: 16:35
 * @var $top_company \common\models\db\TopCompany
 */
use yii\helpers\Html;

?>

    <h3>Голосование</h3>
    <h5><?= $question->title; ?></h5>
    <form class="poll" action="#">
        <?php foreach ($possible_answers as $answer): ?>
            <label><p><input data-id='<?= $answer->id; ?>' name="answer" type="radio"
                             value="<?= $answer->id; ?>"><?= $answer->title; ?></p></label>
        <?php endforeach; ?>
        <!--<input class="add-ad sbm-poll" type="submit" placeholder="Отправить">-->
        <?php if (!Yii::$app->user->isGuest): ?>
            <button class="sbm-poll"><span class="pencil"></span>Проголосовать</button>
        <?php endif; ?>
    </form>
    <?php if(Yii::$app->user->isGuest): ?>
        <h5>Голосовать могут только авторизованные пользователи</h5>
    <?php endif; ?>
