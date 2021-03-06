<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\category_faq\models\CategoryFaq */

$this->title = Yii::t('faq', 'Update Category Faq: ') . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('faq', 'Category Faqs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('faq', 'Update');
?>
<div class="category-faq-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
