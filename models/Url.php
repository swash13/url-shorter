<?php

namespace app\models;

use yii\db\ActiveRecord;

class Url extends ActiveRecord
{
    public static function tableName()
    {
        return 'url';
    }

    public function rules()
    {
        return [
            [['origin', 'short'], 'required'],
            [['origin'], 'string', 'max' => 255],
            [['origin'], 'url'],
            [['short'], 'string', 'max' => 8],
            [['date_add'], 'date', 'format' => 'yyyy-MM-dd HH:mm:ss'],
            [['date_add'], 'default', 'value' => function() { return date('Y-m-d H:i:s'); }],
        ];
    }

    public static function getByUrl($url)
    {
        return Url::findOne(['short' => $url]);
    }

    public function getCountries()
    {
        return Url::hasMany(CountryUrl::className(), ['id_url' => 'id']);
    }

    public function getBrowsers()
    {
        return Url::hasMany(BrowserUrl::className(), ['id_url' => 'id']);
    }
}