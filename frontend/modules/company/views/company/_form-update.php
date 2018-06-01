<?php

use common\models\db\Messenger;
use common\models\db\SocAvailable;
use common\models\db\Tariff;
use kartik\file\FileInput;
use kartik\select2\Select2;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

use common\classes\Debug;

/**
 * @var $this yii\web\View
 * @var $model frontend\modules\company\models\Company
 * @var $form yii\widgets\ActiveForm
 * @var SocAvailable $type
 * @var array $companyRel
 * @var array $categoryCompanyAll
 * @var array $socials
 * @var \common\models\db\Phones $phone
 * */
$this->registerCssFile('/css/board.min.css');
//$this->registerJsFile('/js/board.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/raw/board.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/raw/company.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/secure/js/bootstrap/js/bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<?php $form = ActiveForm::begin(
    [
        'id' => 'update_company',
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
    ]);
?>


<?= $form->field($model, 'slug')->hiddenInput()->label(false); ?>
    <input type="hidden" name="photo" id="" value="<?= $model->photo; ?>">


<?php $model->categ = ArrayHelper::getColumn($companyRel, 'cat_id'); ?>


<?= $form->field($model, 'categ')->widget(Select2::className(),
    [
        'data' => $categoryCompanyAll,
        'options' => [
            'multiple' => true,
            'placeholder' => 'Select a state ...',
            'class' => 'form-control',
            'size' => '1',
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'showToggleAll' => false,
            'tags' => true,
            'maximumSelectionLength' => (isset($services['count_category'])) ? $services['count_category'] : 1,

        ],
    ]);
?>


<?= $form->field($model, 'name')
    ->textInput(['maxlength' => true])
    ->hint('Введите название компании')
    ->label('Название компании')
?>

<?= $form->field($model, 'city_id')->widget(Select2::className(),
    [
        'data' => $city,
        'value' => $model->city_id,
        //'data' => ['Донецкая область' => ['1'=>'Don','2'=>'Gorl'], 'Rostovskaya' => ['5'=>'rostov']],
        'options' => ['placeholder' => 'Начните вводить город ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])
    ->hint('Введите город где находится компания')
    ->label('Город компании')
?>

<?= $form->field($model, 'address')->textInput(['maxlength' => true])
    ->hint('Введите адрес компании без указания города')
    ->label('Адрес компании')
?>

<?= $form->field($model, 'photo', [
    'template' => '<label class="cabinet__add-company-form--add-foto">
                                        <span class="button"></span>
                                        {input}
                                        <img id="blah" src="' . $model->photo . '" alt="" width="160px">
                                        </label>'])
    ->label('Логотип компании')
    ->fileInput();
?>


    <div class="cabinet__add-company-form--block"></div>

<?php if (!empty($phones)): ?>
    <div class="cabinet__add-company-form--wrapper" data-iterator="0" style="flex-wrap: wrap; margin-bottom: 40px;">
        <?php foreach ($phones as $key => $phone): ?>
            <div class="phones__wrap">
                <div class="input__wrap" style="position: relative; width: 100%;">
                    <?= Html::label('Телефон', 'Phones', ['class' => 'label-name']) ?>
                    <?= Html::hiddenInput('Phones[' . $phone->id . '][id]', $phone->id) ?>
                    <?= Html::textInput('Phones[' . $phone->id . '][phone]', $phone->phone, ['class' => 'input-name', 'id' => 'Phones']) ?>
                    <?php if ($key != 0): ?>
                        <button type="button" class="cabinet__remove-pkg company__remove-phone"
                                style="position: absolute; top: 11px; right: 5px; border: none;"></button>
                    <?php else: ?>
                        <button type="button" class="cabinet__add-field company__add-phone"
                                style="position: absolute; top: 11px; right: 5px; border: none;" data-iterator="0"
                                max-count="<?= (isset($services['count_phone']) ? $services['count_phone'] : ''); ?>"></button>
                    <?php endif; ?>
                </div>

                <div class="messengers-choice" style="display: flex; flex-wrap: wrap; width: 70%; margin-left: auto;">
                    <p style="width: 100%; margin-bottom: -1px">Выберите мессенджеры, если у вас привязан к ним
                        телефон</p>
                    <?= Html::checkboxList('Phones[][messengeres]', $phone->getMessengeresArray(), ArrayHelper::map(Messenger::find()->all(), "id", "name"),
                        [
                            'item' =>
                                function ($index, $label, $name, $checked, $value) use ($phone) {
                                    return Html::checkbox("messengeresArray[" . $phone->id . "][]", $checked, [
                                        'value' => $value,
                                        'label' => $label
                                    ]);
                                },
                            'class' => 'checkbox-wrap',
                            'style' => 'display: flex; justify-content: space-around; width: 100%; margin-top: 5px;'
                        ]);
                    ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="cabinet__add-company-form--wrapper" data-iterator="0" style="flex-wrap: wrap; margin-bottom: 40px;">
        <div class="input__wrap" style="position: relative; width: 100%;">
            <?= Html::label('Телефон', 'Phones', ['class' => 'label-name']) ?>
            <?= Html::textInput('Phones[phone]', '', ['class' => 'input-name', 'id' => 'Phones']) ?>
            <button type="button" class="cabinet__add-field company__add-phone"
                    style="position: absolute; top: 11px; right: 5px; border: none;" data-iterator="0"
                    max-count="<?= (isset($services['count_phone']) ? $services['count_phone'] : ''); ?>"></button>
        </div>

        <div class="messengers-choice" style="display: flex; flex-wrap: wrap; width: 70%; margin-left: auto;">
            <p style="width: 100%; margin-bottom: -1px">Выберите мессенджеры, если у вас привязан к ним телефон</p>
            <?= Html::checkboxList('Phones[messengeres]', '', ArrayHelper::map(Messenger::find()->all(), "id", "name"),
                [
                    'item' =>
                        function ($index, $label, $name, $checked, $value) {
                            return Html::checkbox("messengeresArray[0][]", $checked, [
                                'value' => $value,
                                'label' => $label
                            ]);
                        },
                    'class' => 'checkbox-wrap',
                    'style' => 'display: flex; justify-content: space-around; width: 100%; margin-top: 5px;'
                ]);
            ?>
        </div>
    </div>
<?php endif; ?>

<?= $form->field($model, 'email')
    ->textInput(['maxlength' => true])
    ->hint('Введите электронный адрес компании')
    ->label('Email компании');
?>
    <div class="cabinet__add-company-form--block"></div>


<?php if (isset($services['group_link']) && $services['group_link'] == 1): ?>
    <p class="cabinet__add-company-form--title"><b>Соц. сети компании</b></p>
    <?php foreach ($socials as $key => $soc): ?>
        <?= $form->field($soc, "[$key]link",
            [
                'template' => '<span class="social-wrap__item">
                                           <img src=' . "{$soc->getSocType()->one()->icon}" . ' alt="">
                                       </span>
                                   {label}
                                   {input}'
            ])
            ->textInput()
            ->label($soc->getSocType()->one()->name); ?>
    <?php endforeach; ?>
<?php endif; ?>


<?php
$descTemplate = '<label class="label-name" for="company-descr">О компании</label><div class="description-action">{input}</div>';
$descHint = 'Напишите подробное описание компании';
if (isset($services['count_text'])) {
    if ($services['count_text'] != '-') {
        echo $form->field($model, 'descr', ['template' => $descTemplate])
            ->textarea([
                'class' => 'cabinet__add-company-form--text',
                'maxlength' => $services['count_text'],
            ])
            ->hint($descHint)
            ->label(false);
    } else {
        echo $form->field($model, 'descr', ['template' => $descTemplate])
            ->widget(CKEditor::className(), [
                //        'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder', [
                //            'preset' => 'full',
                //            'inline' => false,
                //            'path' => 'frontend/web/media/upload',
                //        ]),
            ])
            ->hint($descHint)
            ->label(false);
    }

} else {
    echo $form->field($model, 'descr', ['template' => $descTemplate])
        ->textarea([
            'class' => 'cabinet__add-company-form--text',
            'maxlength' => 100,
        ])
        ->hint($descHint)
        ->label(false);
}
?>


<?= $form->field($model, 'delivery')
    ->textarea([
        'class' => 'cabinet__add-company-form--text',
    ])
    ->hint('Введите информацию о доставке Вашей компании. Если компания не осуществляет доставку,
        оставьте поле пустым.')
    ->label('Доставка');
?>


<?= $form->field($model, 'payment')
    ->textarea([
        'class' => 'cabinet__add-company-form--text',
    ])
    ->hint('Введите информацию о возможных способах оплаты в вашей компании')
    ->label('Оплаты');
?>

<?php
if (isset($services['count_photo'])) {
    ?>
    <p class="cabinet__add-company-form--title">Загрузите фотографии вашей компании</p>
    <?php
    $preview = [];
    $previewConfig = [];
    if (!empty($img)) {
        foreach ($img as $i) {
            $preview[] = "<img src='$i->photo' class='file-preview-image'>";
            $previewConfig[] = [
                'caption' => '',
                'url' => Url::to(['company/delete-img', 'id' => $i->id]),
            ];
        }
    }

    echo FileInput::widget([
        'name' => 'fileCompanyPhoto[]',
        'id' => 'input-5',
        'attribute' => 'attachment_1',
        'value' => '@frontend/media/img/1.png',
        'options' => [
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
            'maxFileCount' => $services['count_photo'],
            'maxFileSize' => 2000,
            'initialPreview' => $preview,
            'initialPreviewConfig' => $previewConfig,
        ],
    ]);
}
?>


<?= Html::submitButton('Сохранить', ['class' => 'cabinet__add-company-form--submit']) ?>
<?php ActiveForm::end(); ?>