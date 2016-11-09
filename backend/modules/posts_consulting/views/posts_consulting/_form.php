<?php

use common\models\db\CategoryPostsConsulting;
use common\models\db\Consulting;
use common\models\User;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use mihaildev\elfinder\InputFile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\db\CategoryFaq;

/* @var $this yii\web\View */
/* @var $model backend\modules\posts_consulting\models\PostsConsulting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posts-consulting-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'content')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
            'preset' => 'full',
            'inline' => false,
            'path' => 'frontend/web/media/upload',
        ]),

    ])->label('Контент'); ?>

<!--    --><?//= $form->field($model, 'dt_add')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'dt_update')->textInput() ?>

<!--    --><?//= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'photo')->textInput(['maxlength' => true]) ?>

    <div class="imgUpload">
        <div class="media__upload_img"><img src="<?= $model->photo; ?>" width="100px"/></div>
        <?php
        echo InputFile::widget([
            'language' => 'ru',
            'controller' => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
            'filter' => 'image', // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-con..
            'name' => 'PostsConsulting[photo]',
            'id' => 'posts_consulting-photo',
            'template' => '<div class="input-group">{input}<span class="span-btn">{button}</span></div>',
            'options' => ['class' => 'form-control itemImg', 'maxlength' => '255'],
            'buttonOptions' => ['class' => 'btn btn-primary'],
            'value' => $model->photo,
            'buttonName' => 'Выбрать изображение',
        ]);
        ?>
    </div>

<!--    --><?//= $form->field($model, 'user_id')->textInput() ?>


    <?= $form->field( $model, 'user_id' )->dropDownList( ArrayHelper::map( User::find()->all(), 'id', 'username' ), [ 'prompt' => 'Нет' ] ) ?>

<!--    --><?//= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>
    <?= $form->field( $model, 'type' )->dropDownList( ArrayHelper::map( Consulting::find()->all(), 'slug', 'title' ), [ 'prompt' => 'Нет' ] ) ?>
<!--    --><?//= $form->field($model, 'cat_id')->textInput() ?>

    <?php if ( Yii::$app->controller->action->id == 'update' ) { ?>

        <?= $form->field( $model, 'cat_id' )->dropDownList( ArrayHelper::map( CategoryPostsConsulting::find()->where( [ 'type' =>  $model->type] )->all(), 'id', 'title' ) )->label( 'Категория' ) ?>

    <?php } else { ?>

        <?= $form->field( $model, 'cat_id' )->dropDownList( [ ], [ 'style' => 'display:none' ] )->label( 'Категория' ,['style'=>'display:none']) ?>

    <?php }; ?>

<!--    --><?//= $form->field($model, 'views')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('faq', 'Create') : Yii::t('faq', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>