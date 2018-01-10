<?php


use common\classes\Debug;
use common\models\db\CompanyViews;
use yii\db\Query;

//var_dump(Yii::$app->ipgeobase->getLocation('144.206.192.6'));
//var_dump(Yii::$app->ipgeobase->getLocation('144.206.192.6', false));

$ip = '144.206.192.6';
$dbIpTableName = '{{%geobase_ip}}';
$dbCityTableName = '{{%geobase_city}}';
$dbRegionTableName = '{{%geobase_region}}';
$ip = ip2long($ip);

//
$cv = CompanyViews::find()
//    ->select('*')
    ->select('*')
//    ->select(['company_id', 'ip_address', 'count', 'geobase_ip.city_id'])
//    ->join('LEFT JOIN', 'geobase_ip', '`ip_address` BETWEEN `geobase_ip`.`ip_begin` AND `geobase_ip`.`ip_end`')
    ->joinWith('geobaseIp')
    ->all();
//    ->createCommand();
//    ->rawSql;

Debug::dd($cv);

//$re = [];
//foreach ($cv as $item) {
//        /**
//     * @var $item CompanyViews
//     */
//    $re[$item->ip_address] = $item->getGeobaseIp();
//    $re[$item->ip_address]['company'] = $item->company->name;
//    $re[$item->ip_address]['count'] = $item->count;
//}
//
//Debug::dd($re);
$result =
    (new Query())
        ->select([
            't_ip.country_code AS country', 't_region.name AS region', 't_city.name AS city',
            't_city.latitude AS lat', 't_city.longitude AS lng'
        ])
        ->from([
            't_ip' => (new Query())
                ->from($dbIpTableName)
                ->where(['<=', 'ip_begin', $ip])
                ->orderBy(['ip_begin' => SORT_DESC])
        ])
        ->leftJoin(['t_city' => $dbCityTableName], 't_city.id = t_ip.city_id')
        ->leftJoin(['t_region' => $dbRegionTableName], 't_region.id = t_city.region_id')
        ->where(['>=', 't_ip.ip_end', $ip])
        ->one();
//    ->createCommand()
//    ->rawSql;

Debug::prn($result);


?>
