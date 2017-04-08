<?php

namespace backend\modules\category_posts_consulting\controllers;

use yii\web\Controller;

/**
 * Default controller for the `category_posts_consulting` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
