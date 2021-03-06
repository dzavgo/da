<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\company\models\Company */

$this->title = Yii::t('company', 'Create Company');
$this->params['breadcrumbs'][] = ['label' => Yii::t('company', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<div class="company-create">

    <h1><?/*= Html::encode($this->title) */?></h1>

    <?/*= $this->render('_form', [
        'model' => $model,
    ]) */?>

</div>-->
<div class="cabinet__container cabinet__container_white cabinet__inner-box">

    <h3><?= Html::encode($this->title) ?></h3>
    <div class="right">
        <?= $this->render('_form', [
            'model' => $model,
            'city' => $city,
            'categoryCompanyAll' => $categoryCompanyAll,
        ]) ?>
    </div>

</div>