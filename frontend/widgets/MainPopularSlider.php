<?php

namespace frontend\widgets;

use common\classes\Debug;
use common\models\db\News;
use yii\base\Widget;
use yii\db\Expression;

class MainPopularSlider extends Widget
{

    public function run()
    {

        return $this->render('main_popular_slider', [
            'newsSlider1' => News::find()
                ->where(['>', 'dt_add', time() - (86400 * 30)])
                ->andWhere(['exclude_popular' => 0])
                ->orderBy('views DESC')
                ->limit(4)
                ->orderBy(new Expression('rand()'))
                ->with('category')
                ->all(),
            'newsSlider2' => News::find()
                ->where(['>', 'dt_add', time() - (86400 * 30)])
                ->andWhere(['exclude_popular' => 0])
                ->orderBy('views DESC')
                ->limit(4)
                ->orderBy(new Expression('rand()'))
                ->with('category')
                ->all(),
            'newsSlider3' => News::find()
                ->where(['>', 'dt_add', time() - (86400 * 30)])
                ->andWhere(['exclude_popular' => 0])
                ->orderBy('views DESC')
                ->limit(4)
                ->orderBy(new Expression('rand()'))
                ->with('category')
                ->all(),
            'newsSlider4' => News::find()
                ->where(['>', 'dt_add', time() - (86400 * 30)])
                ->andWhere(['exclude_popular' => 0])
                ->orderBy('views DESC')
                ->limit(4)
                ->orderBy(new Expression('rand()'))
                ->with('category')
                ->all(),
        ]);
    }

}