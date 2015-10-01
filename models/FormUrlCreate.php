<?php

namespace app\models;

use yii;
use yii\base\Model;

class FormUrlCreate extends Model
{
    private $_url;
    public $url;


    public function rules()
    {
        return [
            [['url'], 'required', 'message' => 'Введите адрес ссылки'],
            [['url'], 'string', 'max' => 255, 'tooLong' => 'Превышена длина'],
            [['url'], 'url', 'message' => 'Это не адрес ссылки']
        ];
    }

    function attributeLabels()
    {
        return [
            'url' => 'Адрес ссылки'
        ];
    }

    function create()
    {
        if ($this->validate()) {
            $this->_url = new Url();
            $this->_url->origin = $this->url;
            $this->_url->short = Yii::$app->security->generateRandomString(8);

            return $this->_url->save();
        }

        return false;
    }

    function getCreatedUrl()
    {
        return $this->_url;
    }
}