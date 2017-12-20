<?php

namespace frontend\modules\mainpage\widgets;

use common\classes\Debug;
use common\classes\UserFunction;
use yii\base\Widget;

class ShowHotThemeNews extends Widget
{

    public function run()
    {
        $useReg = UserFunction::getRegionUser();

        $query = \frontend\modules\news\models\News::find()
            ->from('news FORCE INDEX(`dt_public`)')
            ->where([ 'hot_new' => 1, 'status' => 0,])
            ->andWhere(['<=', 'dt_public', time() - 86400]);
        if($useReg != -1){
            $query->andWhere("(`region_id` IS NULL OR `region_id`=$useReg)");

        }

        $news = $query
            ->with('tagss.tagname')
            ->orderBy('dt_public DESC')
            ->limit(10)

            ->all();

        $newsAll = array_chunk($news, 5);

        return $this->render('hot-theme',
            [
                'newsLeft' => $newsAll[0],
                'newsRight' => $newsAll[1],
                'userReg' => $useReg,
            ]
        );
    }
}