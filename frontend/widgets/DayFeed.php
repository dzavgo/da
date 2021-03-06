<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 26.09.2016
 * Time: 20:59
 */

namespace frontend\widgets;

use common\classes\Debug;
use common\classes\UserFunction;
use common\models\db\KeyValue;
use common\models\db\Lang;
use Yii;
use yii\base\Widget;

class DayFeed extends Widget
{
    public $useReg;
    public $page = 'page';
    public function run()
    {
        if($this->page == 'dnr') {
            $limit = KeyValue::findOne(['key'=>'day_feed_count_dnr']);
        }else{
            $limit = KeyValue::findOne(['key'=>'day_feed_count']);
        }


        $query = \common\models\db\News::find()
            ->from('news FORCE INDEX(`dt_public`)')
            ->where(['status' => 0]);
        if($this->useReg != -1){
            $query->andWhere("(`region_id` IS NULL OR `region_id`=$this->useReg)");

        }
        $query->andWhere(['in_company' => 0]);
        $query->andWhere(['<=', 'dt_public', time() ]);
        $news = $query->orderBy('dt_public DESC')
            ->limit($limit->value)
            ->all();

        return $this->render('day_feed', [
            'news' => $news,
        ]);
    }

    public static function getDateNew($date)
    {
        $today = date('d.m.Y', time());
        $yesterday = date('d.m.Y', time() - 86400);
        $dbDate = date('d.m.Y', strtotime($date));

        switch ($dbDate) {
            case $today :
                $output = '';
                break;
            case $yesterday :
                $output = 'Вчера в ';
                break;
            default :
                $output = date('d.m', strtotime($dbDate));//date('m.d',$dbDate);
        }
        return $output;
    }
}