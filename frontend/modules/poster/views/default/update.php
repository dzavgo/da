<?php
$this->title = 'Добавление афиши мероприятия';
use yii\bootstrap\ActiveForm;
use yii\helpers\Html; ?>

<div class="cabinet__inner-box">

    <h3>Добавление афиши мероприятия</h3>

        <?php $form = ActiveForm::begin(
            [
                'options' => [
                    'class' => 'cabinet__add-company-form',
                    'enctype' => 'multipart/form-data',
                ],
            ]);
        ?>
        <p class="cabinet__add-company-form--title">Категория</p>
        <div class="cabinet__add-company-form--select-wrapper-cat">

            <?= \kartik\select2\Select2::widget(
                [
                    'name' => 'cat[]',
                    'data' => \yii\helpers\ArrayHelper::map($categoryPoster, 'id', 'title'),
                    'value' => \yii\helpers\ArrayHelper::getColumn($categorySelect, 'cat_id'),
                    'options' => [
                        'placeholder' => 'выберите категорию',
                        'id' => 'form-select',
                        'multiple' => true
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],

                ])?>
        </div>

        <p class="cabinet__add-company-form--title">Название мероприятия</p>

        <?= $form->field( $model, 'title' )->textInput(['maxlength' => true, 'class' => 'cabinet__add-company-form--field'])->label(false); ?>


        <div class="cabinet__add-company-form--block"></div>

        <p class="cabinet__add-company-form--title">Логотип компании</p>

       <!-- <label class="cabinet__add-company-form--add-foto">
            <span class="button"></span>
            <input id="news-photo" class="input-file" type="file">
            <img id="blah" src="" alt="" width="160px">
        </label>-->

    <?php
    if (empty($model->photo)) {
        echo $form->field($model, 'photo', [
            'template' => '<label class="cabinet__add-company-form--add-foto">
                                    <span class="button"></span>
                                    {input}
                                    <img id="blah" src="" alt="" width="160px">
                                    </label>'
        ])->label(false)->fileInput();
    } else {
        echo $form->field($model, 'photo', [
            'template' => '
                    <label class="cabinet__add-company-form--add-foto">
                                    <span class="button"></span>
                                    {input}
                                    <img id="blah" src="' . $model->photo . '" alt="" width="160px">
                                    </label>'
        ])->label(false)->fileInput();
    }
    ?>
    <input type="hidden" name="img" value="<?= $model->photo; ?>" id="">

        <div class="cabinet__add-company-form--block"></div>

        <p class="cabinet__add-company-form--title">Цена посещения</p>
        <?= $form->field( $model, 'price' )->textInput(['maxlength' => true, 'class' => 'cabinet__add-company-form--field'])->label(false); ?>
        <div class="cabinet__add-company-form--block"></div>

        <p class="cabinet__add-company-form--title">Время проведения</p>
        <?= $form->field( $model, 'start' )->textInput(['maxlength' => true, 'class' => 'cabinet__add-company-form--field'])->label(false); ?>
        <div class="cabinet__add-company-form--block"></div>

        <p class="cabinet__add-company-form--title">Дата начала события</p>
        <div class="cabinet__add-company-form--select-wrapper">
            <?php echo \kartik\datetime\DateTimePicker::widget([
            'name' => 'Poster[dt_event]',
            'options' => ['placeholder' => 'Выберете дату события'],
            'convertFormat' => false,
            'value' => date('d-m-Y H:i', (!empty($model->dt_event) ? $model->dt_event : time())),
            'pluginOptions' => [
            'format' => 'dd-mm-yyyy H:i ',
            'startDate' => '01-Mar-2016 12:00 AM',
            'todayHighlight' => true,
            ],
            ]); ?>
        </div>
        <div class="cabinet__add-company-form--block"></div>


        <p class="cabinet__add-company-form--title">Дата окончания события</p>
        <div class="cabinet__add-company-form--select-wrapper">
            <?php echo \kartik\datetime\DateTimePicker::widget([
            'name' => 'Poster[dt_event_end]',
            'options' => ['placeholder' => 'Выберете дату окончания события'],
            'convertFormat' => false,
            'value' => date('d-m-Y H:i', (!empty($model->dt_event_end) ? $model->dt_event_end : time())),
            'pluginOptions' => [
            'format' => 'dd-mm-yyyy H:i ',
            'startDate' => '01-Mar-2016 12:00 AM',
            'todayHighlight' => true,
            ],
            ]); ?>
        </div>
        <div class="cabinet__add-company-form--block"></div>


        <p class="cabinet__add-company-form--title">Адрес проведения</p>
        <?= $form->field( $model, 'address' )->textInput(['maxlength' => true, 'class' => 'cabinet__add-company-form--field'])->label(false); ?>
        <div class="cabinet__add-company-form--block"></div>
        <?php $phone = explode(' ', $model->phone); ?>

        <div class="cabinet__add-company-form--wrapper">

            <p class="cabinet__add-company-form--title">Телефон</p>

            <input class="cabinet__add-company-form--field" name="mytext[]" value="<?= $phone[0]?>" type="text">

            <a href="#" class="cabinet__add-field" max-count="3"></a>

        </div>

        <div class="cabinet__add-company-form--hover-wrapper" data-count="<?= count($phone) - 1; ?>">
            <?php
            unset($phone[0]);

            foreach ($phone as $item):?>
                <?php if(!empty($item)): ?>
                    <div class="cabinet__add-company-form--hover-elements">
                        <p class="cabinet__add-company-form--title"></p>
                        <input class="cabinet__add-company-form--field" value="<?= $item; ?>" type="text" name="mytext[]">
                        <a href="#" class="cabinet__remove-pkg"></a>
                        <p class="cabinet__add-company-form--notice"></p>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <p class="cabinet__add-company-form--title">Описание</p>
        <textarea id="poster-descr" class="cabinet__add-company-form--text" name="Poster[descr]" aria-invalid="false"><?= $model->descr; ?></textarea>
        <!--<div class="cabinet__add-company-form--block"></div>-->

    <?= Html::submitButton( 'Сохранить', [ 'class' => 'cabinet__add-company-form--submit' ] ) ?>
    <?php ActiveForm::end(); ?>

</div>