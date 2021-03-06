<?php
/**
 * Created by PhpStorm.
 * User: Dmitriy
 * Date: 24.11.2017
 * Time: 9:49
 */

namespace frontend\widgets;


use common\classes\Debug;
use common\models\db\Currency;
use common\models\db\CurrencyRate;
use common\models\db\KeyValue;
use yii\base\Widget;
use yii\db\Expression;

class CurrencyRates extends Widget
{
    public $currencyType = Currency::TYPE_CURRENCY;

    public function run()
    {
        //выборка последней даты по типу Валюты(ценности)
        $date = CurrencyRate::find()
            ->joinWith(['currencyFrom cf'])
            ->where([
                'between',
                'date',
                new Expression('CURDATE()-INTERVAL 1 DAY'),
                new Expression('CURDATE()')
            ])
            ->andWhere(['cf.type' => $this->currencyType])
            ->orderBy('date DESC')
            ->one();
        if (empty($date)) $date = new Expression('CURDATE()');
        $rates_body = $rates_title = [];
        $rates = CurrencyRate::find()
            ->joinWith(['currencyFrom cf', 'currencyTo ct'])
            ->where([
                'cf.type' => $this->currencyType,
                'cf.status' => Currency::STATUS_ACTIVE_FOR_WIDGET,
                'ct.status' => Currency::STATUS_ACTIVE_FOR_WIDGET,
            ])
            ->andWhere(['!=', 'ct.id', Currency::UAH_ID])
            ->andWhere(['date' => $date]);
        //Исключаем рубль из криптовалют
        if ($this->currencyType === Currency::TYPE_COIN)
            $rates = $rates->andWhere(['!=', 'ct.id', Currency::RUB_ID])->all();
        else
            $rates = $rates->all();


        switch ($this->currencyType) {
            case Currency::TYPE_COIN:
                $title = KeyValue::findOne(['key' => 'currency_coin_title_page'])->value;
                foreach ($rates as $rate) {
                    if (!isset($rates_body[$rate->currency_from_id])) $rates_body[$rate->currency_from_id] = [
                        'name' => $rate->currencyFrom->coin->full_name,
                        'USD' => null,
                        'EUR' => null,
//                        'RUB' => null
                    ];
                    $rates_body[$rate->currency_from_id][$rate->currencyTo->char_code] =
                        rtrim(number_format($rate->rate, 6, '.', ' '), "0");
                }
                $rates_title = [
                    'name' => 'Криптовалюта',
                    'USD' => 'USD',
                    'EUR' => 'EUR',
//                    'RUB' => 'RUB',
                ];
                break;
            case Currency::TYPE_METAL:
                $title = KeyValue::findOne(['key' => 'currency_metal_title_page'])->value;
                foreach ($rates as $rate) {
                    $rates_body[$rate->currency_from_id] = [
                        'name' => $rate->currencyFrom->name,
                        'char_code' => $rate->currencyFrom->char_code,
                        'rate' => $rate->rate
                    ];
                }
                $rates_title = [
                    'char_code' => 'Металл',
                    'currency' => 'Букв.код',
                    'rate' => 'RUB',
                ];
                break;
            case Currency::TYPE_GSM:
                $title = KeyValue::findOne(['key' => 'currency_petroleum_title_page'])->value;
                foreach ($rates as $rate) {
                    $rates_body[$rate->currency_from_id] = [
                        'name' => $rate->currencyFrom->name,
                        'char_code' => $rate->currencyFrom->char_code,
                        'rate' => $rate->rate
                    ];
                }
                $rates_title = [
                    'char_code' => 'Товар',
                    'currency' => 'Марка',
                    'rate' => 'USD',
                ];
                break;
            default:
                $title = KeyValue::findOne(['key' => 'currency_title_page'])->value;
                foreach ($rates as $rate) {
                    $rates_body[$rate->currency_from_id] = [
                        'currency' => $rate->currencyFrom->name,
                        'char_code' => $rate->currencyFrom->char_code,
                        'rate' => $rate->rate
                    ];
                }
                $rates_title = [
                    'currency' => 'Валюта',
                    'char_code' => 'Букв.код',
                    'rate' => 'RUB',
                ];
        }
        return $this->render('currency', [
            'rates_title' => $rates_title,
            'rates_body' => $rates_body,
            'title' => $title,
        ]);
    }
}