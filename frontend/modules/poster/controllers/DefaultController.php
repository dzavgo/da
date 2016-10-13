<?php

namespace frontend\modules\poster\controllers;

use common\classes\Debug;
use common\models\db\CategoryPoster;
use common\models\db\Poster;
use yii\web\Controller;

/**
 * Default controller for the `poster` module
 */
class DefaultController extends Controller
{
    public $layout = 'portal_page';
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView($slug){
        $poster = Poster::find()->where(['slug'=>$slug])->one();

        return $this->render('view', [
            'poster' => $poster
        ]);
    }

    public function actionCategory(){
        return $this->render('category',[
            'category' => CategoryPoster::find()->orderBy('id DESC')->all(),
        ]);
    }

    public function actionSingle_category($slug){
        Debug::prn($slug);
    }
}
