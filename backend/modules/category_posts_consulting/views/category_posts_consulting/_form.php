<?php


use common\models\db\CategoryPostsConsulting;
use common\models\db\Consulting;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\category_posts_consulting\models\CategoryPostsConsulting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-posts-consulting-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'parent_id')->textInput() ?>

    <?= $form->field($model, 'parent_id')->dropDownList( ArrayHelper::map( CategoryPostsConsulting::find()->all(),'id','title'),[ 'prompt' =>'Нет']) ?>

<!--    --><?//= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'dt_add')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'dt_update')->textInput() ?>

<!--    --><?//= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList(ArrayHelper::map( Consulting::find()->all(),'slug','title'),['prompt'=>'Нет']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('faq', 'Create') : Yii::t('faq', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
