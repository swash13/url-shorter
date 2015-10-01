<?php

namespace app\models;

use yii\base\InvalidParamException;
use yii\db\ActiveRecord;

class CountryUrl extends ActiveRecord
{
    public static function tableName()
    {
        return 'country_url';
    }

    public function rules()
    {
        return [
            [['country_name', 'id_url'], 'required'],
            [['country_name'], 'string', 'max' => 100],
            [['id_url'], 'number'],
            [['id_url'], 'exist', 'targetClass' => Url::className(), 'targetAttribute' => 'id'],
            [['counter'], 'default', 'value' => 0],
            [['counter'], 'number']
        ];
    }

    public static function increment($country, $url)
    {
        if (is_a($url, Url::className())) {
            $url = $url->id;
        }

        if (!is_numeric($url)) {
            throw new InvalidParamException('Url must be a number or object of app\models\Url with id');
        }

        $countryUrl = CountryUrl::findOne(['country_name' => $country, 'id_url' => $url]);
        if (empty($countryUrl)) {
            $countryUrl = new CountryUrl([
                'country_name' => $country,
                'id_url' => $url,
                'counter' => 1
            ]);
        } else {
            $countryUrl->counter++;
        }

        $countryUrl->save();
    }
}