<?php

namespace app\models;

use yii\base\InvalidParamException;
use yii\db\ActiveRecord;

class BrowserUrl extends ActiveRecord
{
    public static function tableName()
    {
        return 'browser_url';
    }

    public function rules()
    {
        return [
            [['browser', 'id_url'], 'required'],
            [['browser'], 'string', 'max' => 100],
            [['id_url'], 'number'],
            [['id_url'], 'exist', 'targetClass' => Url::className(), 'targetAttribute' => 'id'],
            [['counter'], 'default', 'value' => 0],
            [['counter'], 'number']
        ];
    }

    public static function increment($browser, $url)
    {
        if (is_a($url, Url::className())) {
            $url = $url->id;
        }

        if (!is_numeric($url)) {
            throw new InvalidParamException('Url must be a number or object of app\models\Url with id');
        }

        $browserUrl = BrowserUrl::findOne(['browser' => $browser, 'id_url' => $url]);
        if (empty($browserUrl)) {
            $browserUrl = new BrowserUrl([
                'browser' => $browser,
                'id_url' => $url,
                'counter' => 1
            ]);
        } else {
            $browserUrl->counter++;
        }

        $browserUrl->save();
    }
}