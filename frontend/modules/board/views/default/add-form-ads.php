<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $arraregCity */
/* @var $model \frontend\modules\board\models\AdsModel */

use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->registerCssFile('/css/board.min.css');
//$this->registerJsFile('/js/board.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/raw/board.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/secure/js/bootstrap/js/bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="cabinet__container cabinet__container_white cabinet__inner-box">

    <h3>Добавление объявления</h3>
    <div class="right">
    <?php $form = ActiveForm::begin([
        'id' => 'add_ads',
        'options' =>
            [
                'class' => 'content-forma',
                'enctype' => 'multipart/form-data',
            ],
        'fieldConfig' => [
            'template' => '<div class="form-line">{label}{input}<div class="memo-error"><p>{error}</p></div><div class="memo"><span class="info-icon"></span><span class="triangle-left"></span>{hint}</div></div>',
            'inputOptions' => ['class' => 'input-name jsHint'],
            'labelOptions' => ['class' => 'label-name'],
            'errorOptions' => ['class' => 'error'],

            'options' => ['class' => 'form-line'],
            'hintOptions' => ['class' => ''],

        ],
        'errorCssClass' => 'my-error',

    ]); ?>

    <h2 class="soglasie">Общая информация</h2>
    <hr class="lineAddAds"/>

    <?= $form->field($model,'title')->textInput(['maxlength' => 70])
        ->hint('<b>Введите наименование товара, объекта или услуги.</b><br>
                        В заголовке <b>не допускается: номер телефона, электронный адрес, ссылки</b><br>
                        Не допускаются заглавные буквы (кроме аббревиатур).'
        )
        ->label('Заголовок<span>*</span>');
    ?>
    <p class="calc">
        <small>
            <b id="title-count-res" class="counter-placeholder">70</b> знаков осталось
        </small>
    </p>

    <?= $form->field($model, 'category_id',
        ['template' => '<div class=mclass2>{input}<div class="memo-error"><p>{error}</p></div></div>'])
        ->hiddenInput()->label(false);
    ?>

    <label class="label-name">Категория<span>*</span></label>

    <span class="SelectCategory">
                <div class="place-ad__form select-category-add">
                    Выбирите рубрику

                </div>
            </span>

    <hr class="lineAddAds"/>
    <span id="additional_fields"></span>






    <?= $form->field($model, 'content')->textarea(
        [
            'class' => 'area-name jsHint',
            'maxlength' => 4096,
        ]
    )
        ->hint('<b>Добавьте описание вашего товара/услуги,</b> укажите преимущества и важные детали.<br>
                      В описании <b>не допускается указание контактных данных.</b><br>
                      Описание должно соответствовать заголовку и предлагаемому товару/услуге.<br>
                      Не допускаются заглавные буквы (кроме аббревиатур).<br>
            ')
        ->label('Описание<span>*</span>'); ?>
    <p class="calc">
        <small>
            <b id="descr-count-res" class="counter-placeholder">4096</b> знаков осталось
        </small>
    </p>

    <?= $form->field($model, 'price')->textInput()->hint('Пожалуйста, укажите цену. <b>Обратите внимание, что указание нереальной или условной цены (1 руб., 111 руб.) запрещено</b><b>Внимание, цена указывается в российских рублях</b> ')->label('Цена<span>*</span>'); ?>


    <h2 class="soglasie">Фотографии
        <span>(для выбора обложки изображения нажмите на него) </span>
    </h2>
    <hr class="lineAddAds"/>
    <?= $form->field($model, 'cover')->hiddenInput()->label(false);?>
    <?php

    //echo '<label class="control-label">Добавить фото</label>';

    echo FileInput::widget([
        'name' => 'file[]',
        'id' => 'input-5',
        'attribute' => 'attachment_1',
        'value' => '@frontend/media/img/1.png',
        /*'options' => [
            'multiple' => true,
            'showCaption' => false,
            'showUpload' => false,
            'uploadAsync' => false,
        ],
        'pluginOptions' => [
            'uploadUrl' => Url::to(['/site/upload_file']),
            'language' => "ru",
            'previewClass' => 'hasEdit',
            'uploadAsync' => false,
            'showUpload' => false,
            'dropZoneEnabled' => false,
            'overwriteInitial' => false,
            'maxFileCount' => 10,
            'maxFileSize' => 2000,
        ],*/
        'options' => ['multiple' => true, 'accept' => 'image/*'],
        'pluginOptions' => [
            'previewFileType' => 'image',
            'maxFileCount' => 10,
            'maxFileSize' => 2000,
            'language' => "ru",
            'previewClass' => 'hasEdit',
        ]
    ]);

    ?>


    <h2 class="soglasie">Ваши контактные данные</h2>
    <hr class="lineAddAds"/>


    <?= $form->field($model, 'city_id')->widget(Select2::className(),[
        'attribute' => 'state_2',
        'data' => $arraregCity,
        //'value' => $geoInfo['city_id'],
        //'data' => ['Донецкая область' => ['1'=>'Don','2'=>'Gorl'], 'Rostovskaya' => ['5'=>'rostov']],
        'options' => ['placeholder' => 'Начните вводить Ваш город ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]);

    ?>
    <!--<div class="form-line field-ads-name required">
        <div class="form-line">
            <label class="label-name">Местонахождение<span>*</span></label>
            <?/*= Select2::widget([
                'name' => 'Ads[city_id]',
                'attribute' => 'state_2',
                'data' => $arraregCity,
                //'value' => $geoInfo['city_id'],
                //'data' => ['Донецкая область' => ['1'=>'Don','2'=>'Gorl'], 'Rostovskaya' => ['5'=>'rostov']],
                'options' => ['placeholder' => 'Начните вводить Ваш город ...'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);
            */?>
        </div>
    </div>-->

    <?= $form->field($model, 'name')->textInput()->label('Имя<span>*</span>')->hint('как к вам обращаться') ?>




    <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
        'options' => ['class' => 'input-name jsHint',],
        'mask' => ['+9 (999) 999-9999', '+99(999) 999-99-99'],
    ])->label('Телефон<span>*</span>')->hint('как с Вами связаться?') ?>


    <?= $form->field($model, 'mail')
        ->textInput(
            [
                'readonly' => true,
                'value' => \dektrium\user\models\User::find()->where(['id' => Yii::$app->user->id])->one()->email,
            ]
        )
        ->label('Mail<span>*</span>')->hint('Email который вы указали при регистрации')?>

    <h2 class="soglasie">Согласие на обработку данных</h2>
    <hr class="lineAddAds"/>
    <div class="content-dannie">

        <span>
            <input id="dannie-1" type="checkbox" name="option2" value="a2">
            <label for="dannie-1"></label><p>* Я соглашаюсь с
            <a target="_blank" href="<?= Url::to(['/help/default/view', 'slug' => 'obsie-polozenia']) ?>">
                правилами использования сервиса</a>, а также с передачей и обработкой моих данных на DA-INFO. Я подтверждаю своё совершеннолетие и ответственность за размещение объявления</p>
        </span>
    </div>

    <?= Html::submitButton('Oпубликовать',
        ['class' => 'cabinet__add-company-form--submit place-ad_publish publish place-ad__publish', 'disabled' => 'disabled', 'id' => 'saveInfo']) ?>


    <?php ActiveForm::end(); ?>
    </div>
</div>


<div class="modal modal-wide fade modal-categories" id="modalType" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h2>Выберите категорию</h2>
                <span class="krest close"> &times;</span>
            </div>
            <div class="modal-body modal-flex" id="categoryModal">

            </div>


        </div>
    </div>
</div>

